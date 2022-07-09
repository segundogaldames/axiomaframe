<!DOCTYPE html>
<html>
   <head>
   	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Tienda virtual">

    <title>{$title|default:"AxiomaDev"}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <!-- Favicons
    ================================================== -->


   </head>
   <body>


      <div class="content">
            <noscript><p>Debe tener el soporte de Javascript habilitado</p></noscript>

            {include file=$_content}
          </div>


    {if isset($_layoutParams.js) && count($_layoutParams.js)}
      {foreach item=js from=$_layoutParams.js}
        <script type="text/javascript" src="{$js}"></script>
      {/foreach}

    {/if}
  </body>
</html>