<html>
    <head>
    </head>
<body>
    <table width="700px">
        <tr><td>&nbsp</td></tr>
        <tr><td><img src="{{ asset('images/frontend_images/logo.png') }}"></td></tr>
        <tr><td>&nbsp</td></tr>
        <tr><td>Hello {{$name}},</td></tr>
        <tr><td>&nbsp</td></tr>
        <tr><td>Grazie per aver comprato dal nostro Store Online, i dettagli del tuo ordine sono i seguenti:</td></tr>
        <tr><td>&nbsp</td></tr>
        <tr><td>ID Ordine: {{$order_id}}</td></tr>
        <tr><td>&nbsp</td></tr>
        <tr><td>
            <table width="95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                <tr bgcolor="#cccccc">
                    <td>Nome Prodotto</td>
                    <td>Codice Prodotto</td>
                    <td>Quantità</td>
                    <td>Prezzo Unità</td>
                </tr>
                @foreach($productDetails['orders'] as $product)
                    <tr>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['product_code']}}</td>
                        <td>{{$product['product_qty']}}</td>
                        <td>{{$product['product_price']}} €</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="left">Costo Spedizione: </td>
                    <td>{{$productDetails['shipping_charges']}} €</td>
                </tr>
                <tr>
                    <td colspan="5" align="left">Coupon: </td>
                    <td>{{$productDetails['coupon_amount']}} €</td>
                </tr>
                <tr>
                    <td colspan="5" align="left">Totale: </td>
                    <td>{{$productDetails['grand_total']}} €</td>
                </tr>
            </table>
            </td></tr>
            <tr><td>
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td><strong>Fatturazione: </strong></td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['name']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['address']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['city']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['state']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['country']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['pincode']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$userDetails['mobile']}}</td>
                                </tr>
                            </table>
                        </td>
                        <td width="50%">
                            <table>
                                <tr>
                                    <td><strong>Spedizione: </strong></td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['name']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['address']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['city']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['state']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['country']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['pincode']}}</td>
                                </tr>
                                <tr>
                                    <td>{{$productDetails['mobile']}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Per qualisasi problema puoi contattarci personalmente all'indirizzo
                <a href="mailto:info@ecom-website.com">info@ecom-website.com</a>
        </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Grazie,<br>Team Pelazzi.</td></tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</body>
</html>
