<table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp" style="background-color: #f2f2f2; font-family:Arial, Helvetica, sans-serif">
    <tbody>
        <tr>
            <td>
  
              
                <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth" style="background-color: #ffffff; margin-bottom:30px; margin-top:30px">
                    <tbody>
                        <!-- Start header Section -->
                        <tr>
                            <td style="padding-top: 30px;">
  
                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee; text-align: center;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom: 10px;">
                                                <a href="{{env('APP_URL')}}"><img src="{{env('APP_URL').env('INVOICE_LOGO')}}" /></a>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td style="font-size: 14px; line-height: 18px; color: #666666; text-align:center">
                                            {{env('PDF_ORDER_NAME')}}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                            {{env('FIZICKA_ADRESA')}}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom:15px">
                                              <strong>Phone:</strong> {{env('OPCENITO_TELEFON')}} | <strong>Email:</strong> {{env('OPCENITO_EMAIL')}}
                                          </td>
                                      </tr>
                                    </tbody>
                                </table>
   
           
                  
  
                            </td>
                        </tr>
                        
                        <!-- Start product Section -->
                        <tr>
                          <td align="left">
                              <strong>Invoice:</strong> {{ @$order->reference }} 
                          </td>
                       </tr>
                        <tr>
                            <td style="padding-top: 0;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td align="left" width="50%">
                                                        <h3>Billing</h3>
                                                        {{ $order->billingAddress->fullName }}<br>
                                                        @if($order->billingAddress->company_name)
                                                          {{ $order->billingAddress->company_name }}<br>
                                                        @endif
                                                        {{ $order->billingAddress->line_one }}
                                                        @if($order->billingAddress->line_two)
                                                          <br>{{ $order->billingAddress->line_two }}<br>
                                                        @endif
                                                        @if($order->billingAddress->line_three)
                                                          <br>{{ $order->billingAddress->line_three }}<br>
                                                        @endif
                                                        {{ $order->billingAddress->city }}<br>
                                                        {{ $order->billingAddress->state }}<br>
                                                        {{ $order->billingAddress->postcode }}<br>
                                                        {{ $order->billingAddress->country->name }}<br>
                                                        @if($order->customer?->vat_no)
                                                            <p>VAT No.: {{ $order->customer?->vat_no }}</p>
                                                        @endif
                                                    </td>
                    
                                                    <td align="right" width="50%">
                                                      Invoice: {{ @$order->reference }} <br>
                                                        Created: {{ $order->placed_at }}<br>
                                                    </td>
                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                
                              <table cellpadding="0" cellspacing="0" width="100%" class="lines" style="font-size: 14px">
                                  <thead class="lines-heading">
                                      <tr>
                                          <td colspan="4">
                                              <hr>
                                          </td>
                                      </tr>
                                      <tr width="100%" style="text-align: left">
                                          <th>
                                              Product
                                          </th>
                                          
                                          <th width="80" style="text-align: center">
                                              Price
                                          </th>
                                          <th width="20" style="text-align: center">
                                              Qty
                                          </th>
                                          <th width="80" style="text-align: right">
                                              Total
                                          </th>
                                      </tr>
                                      <tr>
                                          <td colspan="4">
                                              <hr>
                                          </td>
                                      </tr>
                                  </thead>
                                  <tbody class="lines-body">
                                      @php
                                          $br = 0;
                                      @endphp
                                    @foreach($order->digitalLines as $line)
                                      @php
                                          $br++;
                                      @endphp
                                      @if ($br > 1)
                                      <tr>
                                          <td colspan="4">
                                              <hr color="#f2f2f2">
                                          </td>
                                      </tr>
                                      @endif
                                      <tr>
                                        <td style="text-align: left; padding-right:15px">
                                          {{ $line->description }} <br>                                       
                                          SKU: <strong>{{$line->identifier}}</strong> 
                                        </td>
                                        <td style="text-align: center">
                                          {{ $line->unit_price->formatted }}
                                        </td>
                                        <td style="text-align: center">
                                          {{ $line->quantity }}
                                        </td>
                                        <td style="text-align: right">
                                          {{ $line->sub_total->formatted }}
                                        </td>
                                   
                                      </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot class="lines-footer">
                                      <tr>
                                          <td colspan="4">
                                              <hr>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td></td>
                                          <td colspan="2" style="text-align: right"><strong>Sub Total</strong></td>
                                          <td style="text-align: right">{{ $order->sub_total->formatted }}</td>
                                      </tr>
                                      @foreach($order->shippingLines as $line)
                                        <tr>
                                          <td></td>
                                          <td colspan="2" style="text-align: right">
                                            <strong>Shipping</strong><br>
                                            <small>{{ strip_tags($line->description) }}</small>
                                          </td>
                                          <td style="text-align: right">{{ $line->sub_total->formatted }}</td>
                                        </tr>
                                      @endforeach
                                      <tr>
                                          <td></td>
                                          <td colspan="2" style="text-align: right"><strong>Tax</strong></td>
                                          <td style="text-align: right">{{ $order->tax_total->formatted }}</td>
                                      </tr>
                                      <tr>
                                          <td></td>
                                          <td colspan="2" style="text-align: right"><strong>Total</strong></td>
                                          <td style="text-align: right">{{ $order->total->formatted }}</td>
                                      </tr>
                                  </tfoot>
                              </table>
                            </td>
                        </tr>
  
  
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
  </table>