<?php

//Verifica, primeiro, se é possível se conectar ao banco de dados
try {
    $connected = ConnectionManager::getDataSource('default');
} catch (Exception $connectionError) {
    $connected = false;
    $errorMsg = $connectionError->getMessage();
    if (method_exists($connectionError, 'getAttributes')):
        $attributes = $connectionError->getAttributes();
        if (isset($errorMsg['message'])):
            $errorMsg .= '<br />' . $attributes['message'];
        endif;
    endif;
}

if (!$connected || !$connected->isConnected()) {
    $this->layout = 'error';
    throw new MissingConnectionException($errorMsg);
}
?>