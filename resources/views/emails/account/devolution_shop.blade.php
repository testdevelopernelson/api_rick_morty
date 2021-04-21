@component('emails.layouts.master')
    <h3 style="font-size: 20px; font-weight: 700; color: #8c8c8c; margin: 14px 0;">Devolución del producto (Referencia del pedido: <strong style="color: #0a51a1;">{{ $data_mail['reference'] }}</strong>)</h3><br>
    
    <h2 style="width: 100%;text-align: left;color: #0a51a1; font-size:16px;margin-bottom:6px;margin-top: 36px;">Datos del cliente</h2>
		<hr>   		
    <p><strong>Nombre: </strong><span>{{ $data_mail['name_user'] }}</span></p>   
    <p><strong>Documento: </strong><span>{{ $data_mail['document'] }}</span></p>   
    <p><strong>Correro electrónico: </strong><span>{{ $data_mail['email'] }}</span></p>   
    <p><strong>Teléfono / celular: </strong><span>{{ $data_mail['phone'] }} / {{ $data_mail['phone'] }}</span></p>
    
     <h2 style="width: 100%;text-align: left;color: #0a51a1; font-size:16px;margin-bottom:6px;margin-top: 36px;">Datos del producto</h2>   
		<hr>		 
    <p><strong>Nombre: </strong><span>{{ $data_mail['name_product'] }}</span></p>   
    <p><strong>Código: </strong><span>{{ $data_mail['codigo'] }}</span></p>   
    <p><strong>SKU: </strong><span>{{ $data_mail['sku'] }}</span></p> 
    
    <h2 style="width: 100%;text-align: left;color: #0a51a1; font-size:16px;margin-bottom:6px;margin-top: 36px;">Datos de  la devolución</h2>   
		<hr>
    <p><strong>Motivo del cambio o devolución: </strong><span>{{ $data_mail['devolution_name'] }}</span></p>   
    <p><strong>Detalles del cambio: </strong><span>{{ $data_mail['devolution_text'] }}</span></p>   
    <p><strong>Imagen adjunta en el correo</strong></p>    
@endcomponent