@foreach($statistics as $key => $statistic)
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-inner">
                <h5 class="card-title">
                    @lang('panel.' . $key)
                </h5>
                <p class="card-text">
                    {{ $statistic }}
                </p>
            </div>
        </div>
    </div>
@endforeach
