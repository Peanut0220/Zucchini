<x-app-layout>
    @if(isset($error))
        <p style="color: red;">{{ $error }}</p>
    @else
        <p><strong>Coupon Code:</strong> {{ $coupon['code'] }}</p>
        <p><strong>Description:</strong> {{ $coupon['description'] }}</p>
        <!-- Add other fields as necessary -->
    @endif
</x-app-layout>
