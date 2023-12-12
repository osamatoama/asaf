<?php /** @noinspection NullPointerExceptionInspection */

namespace App\Http\Controllers\Dashboard\Auth;

use App\Helpers\GlobalConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MyShop\RegisterCompleteRequest;
use App\Http\Requests\Dashboard\MyShop\RegisterUpdateRequest;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Shop;
use App\Services\CityService;
use Exception;
use Gate;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function edit(CityService $cityService)
    {
        abort_if(Gate::denies('register_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = dashboard()->authUser();

        $shop = $user->getMerchantShop() ?? new Shop();
        $shop->load('user', 'city');

        abort_if(((int)$shop->active) !== GlobalConstants::INACTIVE_SHOP, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = $cityService->getPluckCities(['asc' => true], locale()->current())
            ->prepend(trans('global.pleaseSelect'), '');

        $country = Country::first();

        return view('dashboard.pages.auth.register-edit',
            compact('cities', 'country', 'shop'));
    }

    public function update(RegisterUpdateRequest $request): ?RedirectResponse
    {
        $user = dashboard()->authUser();
        abort_if(!$user->isMerchant(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop = $user->getMerchantShop();
        abort_if(((int)$shop->active) !== GlobalConstants::INACTIVE_SHOP, Response::HTTP_FORBIDDEN, '403 Forbidden');


        try {
            DB::beginTransaction();

            $user->updateQuietly($request->only([
                'name',
                'email',
                'land_line',
            ]));

            $request['active'] = GlobalConstants::PENDING_SHOP;

            $shop->updateQuietly($request->only([
                'commercial_name',
                'commercial_registration_number',
                'written_tax_number',
                'city_id',
                'active',
            ]));

            Setting::updateOrCreate([
                'user_id' => $user->id,
                'key'     => 'address',
                'type'    => Setting::SHOP_SETTING,
            ], [
                'value' => $request->get('address'),
            ]);

            Setting::updateOrCreate([
                'user_id' => $user->id,
                'key'     => 'zip_code',
                'type'    => Setting::SHOP_SETTING,
            ], [
                'value' => $request->get('zip_code'),
            ]);

            if ($request->filled('commercial_record') && (!$shop->commercial_record->media || $request->get('commercial_record') !== optional($shop->commercial_record->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('commercial_record'))))
                    ->toMediaCollection('commercial-record');
            }
            if ($request->filled('tax_number') && (!$shop->tax_number->media || $request->get('tax_number') !== optional($shop->tax_number->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('tax_number'))))
                    ->toMediaCollection('tax-number');
            }

            if (!$request->filled('metal_license')) {
                $shop->clearMediaCollection('metal-license');
            }
            if ($request->filled('metal_license') && (!$shop->metal_license->media || $request->get('metal_license') !== optional($shop->metal_license->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('metal_license'))))
                    ->toMediaCollection('metal-license');
            }

            if ($request->filled('logo') && (!$shop->logo->media || $request->get('logo') !== optional($shop->logo->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('logo'))))
                    ->toMediaCollection('shop-logos');
            }

            if (!$request->filled('cover_image')) {
                $shop->clearMediaCollection('shop-banners');
            }
            if ($request->filled('cover_image') && (!$shop->banner->media || $request->get('cover_image') !== optional($shop->banner->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('cover_image'))))
                    ->toMediaCollection('shop-banners');
            }

            DB::commit();
            return redirect()->route('dashboard.home');
        } catch (Exception $e) {
            Db::rollBack();
            return back()->with('error_message', trans('merchant/register.Something went wrong Please try again'));
        }
    }

    /**
     * @throws BindingResolutionException
     */
    public function complete(RegisterCompleteRequest $request)
    {
        $user = dashboard()->authUser();

        abort_if(!isMerchant(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop = $user->getMerchantShop();

        abort_if(((int)$shop->active) !== GlobalConstants::PENDING_SHOP, Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            DB::beginTransaction();

            $user->update(['step' => GlobalConstants::AFTER_BUSINESS_DATA]);

            $shop->updateQuietly($request->only([
                'commercial_registration_number',
                'written_tax_number',
            ]));

            if ($request->filled('commercial_record') && (!$shop->commercial_record->media || $request->get('commercial_record') !== optional($shop->commercial_record->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('commercial_record'))))
                    ->toMediaCollection('commercial-record');
            }
            if ($request->filled('tax_number') && (!$shop->tax_number->media || $request->get('tax_number') !== optional($shop->tax_number->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('tax_number'))))
                    ->toMediaCollection('tax-number');
            }
            if ($request->filled('metal_license') && (!$shop->metal_license->media || $request->get('metal_license') !== optional($shop->metal_license->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('metal_license'))))
                    ->toMediaCollection('metal-license');
            }

            if ($request->filled('logo') && (!$shop->logo->media || $request->get('logo') !== optional($shop->logo->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('logo'))))
                    ->toMediaCollection('shop-logos');
            }
            if ($request->filled('cover_image') && (!$shop->banner->media || $request->get('cover_image') !== optional($shop->banner->media)->file_name)) {
                $shop->addMedia(storage_path('tmp/uploads/' . basename($request->get('cover_image'))))
                    ->toMediaCollection('shop-banners');
            }

            notifyAdminsAndSubAdmins('تم تسجيل متجر جديد #' . $shop->id);

            DB::commit();
            if ($request->expectsJson()) {
                $gtm = gtm()->submitApplication($shop, $user->fresh(), 4);

                return response()->json(['success' => true, 'gtm' => $gtm]);
            }
            return back();
        } catch (Exception $e) {
            Db::rollBack();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => trans('merchant/register.Something went wrong Please try again'),
                ]);
            }
            return back()->with('error_message', trans('merchant/register.Something went wrong Please try again'));
        }
    }
}
