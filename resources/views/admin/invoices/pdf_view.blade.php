<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - Prestine Cleaners</title>
    
    <style>

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            /*border: 1px solid #eee;*/
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
            line-height: 1.2;
        }

        .invoice-box table tr.top table td.logo {
            text-align: left; 
            padding-bottom: 0px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 16px;
            text-align: left;
            color: #333;
        }

        .invoice-box table tr.top table td.invoice {
            font-size: 14px;
        }

        .invoice-box table tr.top table td.invoice span {
            font-size: 16px;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.information table td p.bill_to {
            font-size: 16px;
        }

        .invoice-box table tr.information table td p.customer_details {
            font-size: 14px;
            line-height: 1.2;
        }

        .invoice-box table tr.information table td p.datess {
            font-size: 14px;
            line-height: 1.2;
            text-align: right;
        }
        
        .invoice-box table tr.heading th {
            background-color: #eee;
            font-size: 14px;
            padding: 5px;
        }

        .invoice-box table tr.items td {
            background-color: #fff;
            font-size: 14px;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.items.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total table tr.notes p {
            font-size: 14px;
            line-height: 1.2;
            text-align: left;
        }

        .invoice-box table tr.total table tr.notes table.total_due {
            padding: 5px;
        }

        .invoice-box table tr.total table tr.notes table.total_due tr th {
            font-size: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.total table tr.notes table.total_due tr td {
            font-size: 14px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .footer {
           position: fixed;
           left: 0;
           bottom: 0;
           /*bottom: 10px;*/
           width: 100%;
           height: 100px;
        }

        .footer p.terms {
            text-align: left;
            font-weight: 12px;
            line-height: 1.2;
        }

        .footer p.company_info {
            border-top: 1px solid #eee;
            color: black;
            text-align: center;
            padding-top: 10px;
        }
    
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <tr class="top">
                    <td colspan="5">
                        <table style="width: 100%;">
                            <tr>
                                <td class="logo">
                                    <img src="http://prestinecleaners.co.uk/assets/img/logo/prestine_logo_3.png" alt="prestine cleaners" />
                                </td>
                            </tr>
                            <tr>
                                <td class="title">
                                    Prestine Cleaners<br/>
                                    18 King Edward Street,<br/>
                                    Slough SL1 2QS
                                </td>
                                                      
                                <td class="invoice">
                                    <span>INVOICE</span><br/> 
                                    # {{ $invoice->invoice_no }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td style="text-align: left;">
                                    <p class="bill_to">Bill To:</p>
                                    <p class="customer_details">
                                        Mr/Ms. {{ $invoice->user->name }}<br/>
                                        {{ $invoice->user->email }}<br/>
                                        {{ $invoice->user->phone }}
                                    </p>
                                </td>
                                
                                <td>
                                    <p class="datess" style="text-align: right;">
                                	    <b>Issue Date:</b> {{ date('d/m/Y', strtotime($invoice->invoice_date)) }}<br/>
                                        <b>Due Date:</b> {{ date('d/m/Y', strtotime($invoice->due_date)) }}
                                        <br/><br/>
                                        <b>Payment Terms:</b> {{ $invoice->payment_terms }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="heading">
                    <th style="width: 5%;">#</th>
                    <th style="width: 35%; text-align: left;">
                        Item & Description
                    </th>
                    <th style="width: 20%; text-align: right;">
                    	Price/Rate
                    </th>
                    <th style="width: 20%; text-align: center;">
                    	Quantity
                    </th>
                    <th style="width: 20%; text-align: right;">
                        Total
                    </th>
                </tr>
               	@foreach($invoice->invoice_items as $key => $item)
    		  	<tr class="items">
    		      	<td style="text-align: center;">{{ $key + 1 }}</td>
    		      	<td style="text-align: left;">
    		      		{{ $item->item_description }}
    		      	</td>
    		      	<td style="text-align: right;">&pound; {{ $item->rate }}</td>
    		      	<td style="text-align: center;">{{ $item->quantity }}</td>
    		      	<td style="text-align: right;">&pound; {{ $item->amount }}</td>
    		  	</tr>
    		  	@endforeach 
                
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr class="total">
                    <td colspan="5">
                        <table>
                            <tr class="notes">
                                <td style="width: 60%;">
                                    @if(isset($invoice->additional_notes))
                                        <p>Notes:</p>
                                        <p>{{ $invoice->additional_notes }}</p>
                                    @endif
                                </td>
                                <td style="width: 40%;">
                                    <table class="total_due">
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th>Sub Total:</th>
                                            <td>
                                                &pound; {{ $invoice->sub_total }}
                                            </td> 
                                        </tr>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th>Tax/VAT: </th>
                                            <td>
                                               &pound; {{ $invoice->tax }}
                                            </td> 
                                        </tr>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th>Discount:</th>
                                            <td>
                                                &pound; {{ $invoice->discount }}
                                            </td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th>Total:</th>
                                            <td>
                                                &pound; {{ $invoice->total }}
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p class="terms">
            <b>Legal Terms</b>
            <br/>
            Please note: Any payment made after its due date there will be 8% late payment fee charges will be applicable on daily basis.
        </p>
        <p class="company_info">
            www.prestinecleaners.co.uk
            &nbsp;|&nbsp;
            info@prestinecleaners.co.uk
            &nbsp;|&nbsp;
            07387 312 723
        </p>
    </div>
</body>
</html>
















