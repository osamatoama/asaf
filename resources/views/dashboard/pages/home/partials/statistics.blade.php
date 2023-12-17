@foreach($statistics as $key => $statistic)
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-inner">
                <h5 class="card-title">
                    @lang('dashboard/statistics.' . $key)
                </h5>
                <p class="card-text" style="font-size: large; color: #9d72ff; font-weight: bold;">
                    {{ $statistic }}
                </p>
            </div>
        </div>
    </div>
@endforeach
