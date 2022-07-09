<!DOCTYPE html>
<html>
   <head>
   	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="frame de aplicaciones web">

    <title>{$title|default:"AxiomaFrame"}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {include file="link_css.tpl"}


   </head>
   <body>
  {include file="menu.tpl"}

      <div class="container">


            {include file=$_content}
          </div>

    {include file="link_js.tpl"}

    <noscript>
      <p>Debe tener el soporte de Javascript habilitado</p>
    </noscript>

    {if isset($_layoutParams.js) && count($_layoutParams.js)}
      {foreach item=js from=$_layoutParams.js}
        <script type="text/javascript" src="{$js}"></script>
      {/foreach}

    {/if}
  </body>
</html>