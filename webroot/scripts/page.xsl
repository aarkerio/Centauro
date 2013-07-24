<?xml version="1.0" encoding="iso-8859-1"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!-- Template 1 -->
<xsl:template match='/'>
  <html> 
  <xsl:apply-templates /> 
</html>
</xsl:template>

<!-- Template 2 -->
<xsl:template match='page'>
  <head><title><xsl:value-of select='nombre' /> (Generado por books2.xsl)</title>
  <link rel="stylesheet" type="text/css" href="../archivos/books.css" 
              title="Style"/>
  </head>
  
  <body>

    <h1><xsl:value-of select='urlbase' /> </h1>
    
    <h2>Teléfono: <xsl:value-of select='lema' /> </h2>

    <h2>Libros en existencia </h2>
    <table style="border:1px solid black;">
      <tr class="denso">
           <td>Autor</td><td>Título</td><td>Género</td><td>Precio</td>
	   <td>Fecha de publicacion</td><td>Descripción</td>
       </tr>
      <!-- se usa el atributo "select" apara indicar que se incluyan sólo a esta etiqueta -->
      <xsl:apply-templates select='email' />
    </table>
  </body>
</xsl:template>




</xsl:stylesheet>
