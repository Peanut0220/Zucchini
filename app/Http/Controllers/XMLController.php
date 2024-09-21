<?php
//Author: Chong Jian & Shi Lei
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Food;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Delivery;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use \XMLWriter as XMLW;
use Illuminate\Support\Facades\Session;

class XMLController extends Controller
{
    //Author : All

    public function xmlFoodList()
    {
        $foods = Food::all();
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;
        $xml->appendChild($xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/xml/foods.xsl"'));

        $root = $xml->createElement('Foods');
        $xml->appendChild($root);

        foreach ($foods as $food) {
            $foodNode = $xml->createElement('Food');
            $root->appendChild($foodNode);

            $foodNode->appendChild($xml->createElement('ID', $food->food_id));
            $foodNode->appendChild($xml->createElement('Name', $food->name));
            $foodNode->appendChild($xml->createElement('Description', $food->description));
            $foodNode->appendChild($xml->createElement('Price', $food->price));
        }

        $path = public_path('xml/foods.xml');
        if ($xml->save($path)) {
            return $path;
        } else {
            return response()->json(['error' => "Failed to save XML file."], 500);
        }
    }

    public function xmlOrderList() {


        $customerId = Auth::id();
        $orders = Order::where('user_id',$customerId)->get();
        // Create a new DOMDocument
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $xml->appendChild($xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="/xml/orders.xsl"'));

        // Add root element
        $root = $xml->createElement('Orders');
        $xml->appendChild($root);

        // Iterate over orders and add to XML
        foreach ($orders as $order) {
            $orderNode = $xml->createElement('Order');
            $root->appendChild($orderNode);

            $idNode = $xml->createElement('OrderID', $order->order_id);
            $orderNode->appendChild($idNode);

            $finalNode = $xml->createElement('Total', $order->final);
            $orderNode->appendChild($finalNode);

            $paymentNode = $xml->createElement('PaymentType', $order->payment_type);
            $orderNode->appendChild($paymentNode);

            $createAtNode = $xml->createElement('CreatedAt', $order->created_at);
            $orderNode->appendChild($createAtNode);
        }

        $path = public_path('xml/orders.xml');

        if ($xml->save($path)) {
            return $path;
        } else {
            return response()->json(['error' => "Failed to save XML file."], 500);
        }
    }


}
