<?php
echo '<html>';
echo '<head>';
echo '<script type="text/javascript">
var xmlHttp;

function getXMLHttpRequest(){
var xmlHttp = null;
try{
	xmlHttp = new XMLHttpRequest();
	} catch(e){
	try{
	xmlHttp = new ActiveXObject(\'Msxml2.XMLHTTP\');
	} catch(e){
	xmlHttp = new ActiveXObject(\'Microsoft.XMLHTTP\');
	}
	}
	return xmlHttp;
	}
	
	function stateChanged(){
	if ((xmlHttp.readyState == \'4\') || (xmlHttp.readyState == \'complete\')) {
	document.getElementById(\'id_result\').innerHTML = xmlHttp.responseText;
	}
    }

    function getProducts() {
        xmlHttp = getXMLHttpRequest();
        if (xmlHttp == null) {
            alert(\'Browser Tidak Support Ajax\');
            return;
        }
        var url = \'http://localhost/RESTful/get_product.php\';
        url += \'?product_id=\' + document.getElementById(\'input_text\').value;
        xmlHttp.onreadystatechange = stateChanged;
        xmlHttp.open(\'GET\', url, true);
        xmlHttp.send(null);
    }//]]>
    </script>';

echo '</head>';
echo '<body>';
echo '<div id="id_result"></div>';
echo '<input type="text" id="input_text" />';
echo '<input type="button" onclick="getProducts(); " value="Ambil Data." />';
echo '</body>';
echo '</html>';
?>
