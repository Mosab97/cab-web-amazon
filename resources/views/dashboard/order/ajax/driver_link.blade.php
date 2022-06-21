@if ($driver)
    <a href="{!! route('dashboard.driver.show',$driver->id) !!}">{{ $driver->fullname }}</a>
@endif
