<x-app-layout>
    @foreach($coupons as $coupon)
        <li>{{ $coupon['code'] }} - Discount: {{ $coupon['discount'] }}% </li>
    @endforeach
</x-app-layout>
