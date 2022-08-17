# Editrade SIGAD API

Esto es una API intermedia para integrar el webservice de Sigad Editrade en tus aplicaciones PHP.

> Debes contar con el webservice habilitado por Editrade, ya que ellos te facilitarán las credenciales necesarias para interactuar con su API.

## Instalación

```composer install jsanbae/sigad_api```

## Configuración

### 1. Crear un Agente de Aduana
Debes crear una clase que herede la clase **Jsanbae\SigadAPI\ClienteSigad**. Te recomiendo usar la clase **AgenteDemo.php** como ejemplo. 

### 2. Conectar el Agente con la API 
```(php)
use Jsanbae\SigadAPI\SigadAPI;

$agente = new AgenteDemo();
$api = new SigadAPI($agente);
```

## Casos de Uso (Algunos)

### Consultar despachos creados de hoy (Evento DeclaracionCreada)
```(php)
use Jsanbae\SigadAPI\Despacho;
use Jsanbae\SigadAPI\SigadAPI;
use Jsanbae\SigadAPI\Events\DeclaracionCreada;

$agente = new AgenteDemo();
$api = new SigadAPI($agente);

$fecha_desde = date('Y-m-d');
$fecha_hasta = date('Y-m-d');
$despachosData = $api->MovimientosCliente()->Consultar(new DeclaracionCreada, $fecha_desde, $fecha_hasta);

$despachos = [];
foreach ($despachosData as $despachoObject) {
    $despacho = new Despacho($despachoObject->DESPACHO, $this->agente);
    $despacho->populateFromObject($despachoObject);

    $despachos[] = $despacho;
}

var_dump($despachos);
```

### Obtener PDF(codificado base64) de una Declaración
```(php)
use Jsanbae\SigadAPI\SigadAPI;
use Jsanbae\SigadAPI\Despacho;

$agente = new AgenteDemo();
$api = new SigadAPI($agente);

$despacho = new Despacho(123456, $agente);
$despachoPDFBase64 = $api->DespachoAgencia()->getPDFBase64($despacho);

$file_decoded = base64_decode($despachoPDFBase64);
file_put_contents('despacho.pdf', $file_decoded);
```

## Eventos
Esta API viene con algunos eventos predefinidos, tales como:
- `Jsanbae\SigadAPI\Events\DeclaracionCreada` Evento de Declaracion creada
- `Jsanbae\SigadAPI\Events\AclaradoAceptado` Evento de Delcaracipon Aclarada y posteriomente Aceptada por Aduana
- `Jsanbae\SigadAPI\Events\DeclaracionAceptada` Evento de Declaracion Aceptada por Aduana
- `Jsanbae\SigadAPI\Events\DIAceptada` Evento de Declaracion de Ingreso Aceptada por Aduana
- `Jsanbae\SigadAPI\Events\DUSLegalizada` Evento de DUS Legalizado por Aduana
- `Jsanbae\SigadAPI\Events\EventoDinamico` Evento comodín que puede tomar cualquier valor. Recibe como argumento el código del evento.

## Documentación del Webservice
La documentación puedes encontrarla en el directorio **docs** de este repositorio.

## Contribuciones

Sugiere tus propias mejoras, te invito a discutirlas en "Issues" antes de enviar tus "Pull Requests".

Los "Pull requests" para bugs siempre son bienvenidos, por favor explica tu bug que estás intentando corregir en el mensaje.

Hay sólo algunas pruebas unitarias en el PHPUnit. Sería genial tener  más tests para obtener mayor cobertura en otros casos. Sientete libre en contribuir con eso.