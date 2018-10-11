<style>
    * {font-family: segoe ui;}
    body {height: 29.7cm; width: 22cm; background-color: white; margin: 0; padding: 0;}
    .bold {font-weight: bold;}
    div#rapportino {margin: 1cm; height: 27.7cm; width: 20cm; border: 0pt solid grey; padding: 0.5cm;}

    div#logo { position: absolute; top: 1cm; left: 1.5cm; height: 4cm; width: 4cm;}
    div#intestazione{ position: absolute; top: 1.5cm; left: 5.5cm; height: 2cm; width: 16cm;  overflow: hidden; }
    div#intestazione span.main { font-size: 15pt; font-weight: bold; line-height: 0.8cm; }
    div#intestazione span.sub { font-size: 9pt; line-height: 0.5cm;}

    div#infoCliente { position: absolute; top: 4.5cm; left: 1.5cm; height: 3.5cm; width: 9.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#infoCliente div {}
    div#infoConsulente { position: absolute; top: 4.5cm; left: 11.5cm; height: 3.5cm; width: 9.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#infoConsulente div {}
    div#infoContratto {position: absolute; top: 8.5cm; left: 1.5cm;  height: 1.8cm; width: 9.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#infoContratto div {}
    div#infoRapportino { position: absolute; top: 8.5cm; left: 11.5cm; height: 1.8cm; width: 9.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#infoRapportino div {}
    div#testo{position:absolute; top:11cm; left:1.5cm; height: 16.5cm; border: 1px solid red; overflow:hidden;}
    div#attivitaPianificate {  left: 1.5cm;  width: 19.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#attivitaSvolte { left: 1.5cm; width: 19.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#attivitaInCaricoCliente {  left: 1.5cm; width: 19.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#attivitaProgrammate {   left: 1.5cm; width: 19.5cm; border: 1pt solid grey; padding: 0.2cm;}
    div#firmaConsulente { position: absolute; top: 28cm; left: 1.5cm; height: 1.2cm; width: 8cm; border-bottom: 1pt solid grey; padding: 0.2cm;}
    div#firmaCliente { position: absolute; top: 28cm; left: 11cm; height: 1.2cm; width: 8cm; border-bottom: 1pt solid grey; padding: 0.2cm;}
    div#titolo { text-align: right; background-color: #ffffff; font-size: 8pt; font-weight: bold; margin: -0.15cm; padding: 0.05cm; color: #bfbfbf;}
</style>
<html>
<body>

<div id='rapportino'>
    <div id='testata'>
        <div id="logo">
            <img src='<?=public_path()?>/img/logo.gif'>
        </div>
        <div id="intestazione">
            <span class='main'>TEIKOS SOLUTIONS s.r.l </span><br/>
            <span class='sub'>Sede legale e uffici: Via A. Gordini n. 3 | 47122 Forl&igrave; | www.tksol.net | PIVA CF 03349380406 - C.C.I.A.A. 296802<br/>+39 0543.796018 | solutions@teikos.it<br/></span>
        </div>
    </div>
    <div id='infoCliente'>
        <div id='titolo'>DATI CLIENTE</div>
        <div class='bold'>Ragione Sociale</div>
        <div>Indirizzo</div>
        <div>Indirizzo</div>
        <div>Telefono</div>
        <div>Mail</div>
    </div>
    <div id='infoConsulente'>
        <div id='titolo'>DATI CONSULENTE</div>
        <div class='bold'>Consulente</div>
        <div>Ruolo</div>
        <div>Mail</div>
        <div>Tel</div>
    </div>
    <div id='infoContratto'>
        <div id='titolo'>CONTRATTO</div>
        <div class='bold'>Contratto</div>
        <div>Progetto</div>
        <div>Attivit&agrave;</div>
    </div>
    <div id='infoRapportino'>
        <div class='bold'>Tipo rapportino</div>
        <div>Data</div>
        <div>Inizio 00:00 - Fine 00:00</div>
    </div>
    <div id='testo'>
        <div id='attivitaPianificate'>
            <div id='titolo'>ATTIVIT&Agrave; PIANIFICATE</div>
        </div>
        <div id='attivitaSvolte'>
            <div id='titolo'>ATTIVIT&Agrave; SVOLTE</div>
            <h1>TEST</h1><p>{!! $intervento !!}</p>
        </div>
        <div id='attivitaInCaricoCliente'>
            <div id='titolo'>ATTIVIT&Agrave; IN CARICO AL CLIENTE</div>
        </div>
        <div id='attivitaProgrammate'>
            <div id='titolo'>ATTIVIT&Agrave; PROGRAMMATE</div>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, aperiam architecto blanditiis, commodi consequuntur culpa eos facere incidunt inventore iusto officiis provident quae, quas ratione recusandae saepe sequi tenetur voluptatum!
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda at, beatae consectetur fuga hic in ipsum neque, nulla perferendis reprehenderit rerum sed voluptate. Consectetur dolorem dolores optio quae tenetur.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aliquam aliquid, beatae dicta dolorum error id itaque laboriosam magnam, minus nobis optio perspiciatis possimus provident recusandae vero vitae voluptates voluptatibus?
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos esse facilis impedit iste laudantium maxime nisi officiis porro praesentium, provident quidem reiciendis repellat rerum temporibus veritatis voluptates. Dignissimos.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At aut autem corporis deserunt dolore ea eveniet ex in libero maxime modi nisi perferendis quas, repudiandae sequi similique, sint suscipit voluptates?
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda at, beatae consectetur fuga hic in ipsum neque, nulla perferendis reprehenderit rerum sed voluptate. Consectetur dolorem dolores optio quae tenetur.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aliquam aliquid, beatae dicta dolorum error id itaque laboriosam magnam, minus nobis optio perspiciatis possimus provident recusandae vero vitae voluptates voluptatibus?
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos esse facilis impedit iste laudantium maxime nisi officiis porro praesentium, provident quidem reiciendis repellat rerum temporibus veritatis voluptates. Dignissimos.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At aut autem corporis deserunt dolore ea eveniet ex in libero maxime modi nisi perferendis quas, repudiandae sequi similique, sint suscipit voluptates?
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi assumenda at, beatae consectetur fuga hic in ipsum neque, nulla perferendis reprehenderit rerum sed voluptate. Consectetur dolorem dolores optio quae tenetur.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aliquam aliquid, beatae dicta dolorum error id itaque laboriosam magnam, minus nobis optio perspiciatis possimus provident recusandae vero vitae voluptates voluptatibus?
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos esse facilis impedit iste laudantium maxime nisi officiis porro praesentium, provident quidem reiciendis repellat rerum temporibus veritatis voluptates. Dignissimos.
            <br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At aut autem corporis deserunt dolore ea eveniet ex in libero maxime modi nisi perferendis quas, repudiandae sequi similique, sint suscipit voluptates?
        </div>
    </div>
    <div id='firmaCliente'>
        <span>Referente cliente</span>
    </div>
    <div id='firmaConsulente'>
        <span>Consulente</span>
    </div>
</div>

</body>
</html>