<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once 'visao/Tela.php';
/**
 * Descrição da Home
 *
 * @Autor Valter Vasconcelos 05/07/2012
 * 
 */
class Home extends Tela{
    var $sConteudo;

    function Home(){
        $this->fachadaControl = $this->getInstanciaControle();
        $sNivelUsuario  = $_SESSION[SESSAOEMPRESA]['usrt_dsc'];

        $sConteudo = $this->cabecalhoSistema("home");
        $sConteudo.= "<div id='principal'>"; //Abre div Principal
        $sConteudo.= $this->getMenuPrincipal();
        
        $retornoIcone = $this->fachadaControl->listarPontoIconeFrameVeiculoGrid();        
        $retornoMenu	= "";

        foreach($retornoIcone as $pontoIcone){
            $retornoMenu   .= "	<li><a href=''><span class='onlyMakersGroup' id='{$pontoIcone['ptic_dsc']}' title='{$pontoIcone['ptic_dsc']}'><img src='imagens/enter.gif' width='12' height='12' />&nbsp;{$pontoIcone['ptic_dsc']}</span></a></li><br>";
            $cont++;
        }
        //Div da mascara para cadastros!!!
        $sConteudo.= "
            <span class='TipoMapa'><strong><div id='lblTrocaMapa'>Mapa</div></strong>
                <ul>
                    <li><a style='cursor: pointer;' onclick=\"troca_mapa('mapa');\">Mapa</a></li>
                    <li><a style='cursor: pointer;' onclick=\"troca_mapa('sate');\">Satélite</a></li>
                    <li><a style='cursor: pointer;' onclick=\"troca_mapa('hibr');\">Híbrido</a></li>
                    <li><a style='cursor: pointer;' onclick=\"troca_mapa('terr');\">Terreno</a></li>
                    ".(ESQUEMA == 'portosat' ? "<li><a style='cursor: pointer;' onclick=\"troca_mapa('carta');\">Carta</a></li>" : '')."
                </ul>
            </span>
            
            <span class='PontosMapa'><strong>Pontos no Mapa</strong>
                <ul id='liPontos'>
                    {$retornoMenu}
                </ul>
            </span>
            
            <div id=\"map_canvas\"></div>       <!-- Início do Mapa -->            
            <div id=\"windowComando\"></div>    <!-- Janela de \"Envio de Comandos\" -->
            <div id=\"windowSOS\"></div>        <!-- Janela de \"SOS\" -->
            <div id=\"windowCERCAIN\"></div>	<!-- Janela de \"DENTRO DA CERCA\" -->
            <div id=\"windowCERCAOUT\"></div>	<!-- Janela de \"FORA DA CERCA\" -->
            <div id=\"preloader\"> </div>

            <div id=\"homeContainers\">
                <div id=\"Cadastro\" class=\"window\"></div>

                <!-- Janela Modal com caixa de diálogo -->
                <div id=\"mask\">
                    <a href=\"#\" id=\"close\" class=\"close\"></a><br />
                    <div id='cadContainer'></div>
                </div>
            </div>";
        
        $sConteudo .= $this->getGridsRodape();
        
        $sConteudo.= "</div>";  //Fecha div Principal

        $carregaEventos = (in_array($sNivelUsuario, array('MONITORADOR', 'USUÁRIO GERENTE', 'USUÁRIO SUB-GERENTE', 'USUÁRIO TESTE')) ?
           "carrega_eventos(\"".PATHPRINCIPAL."/jsoneventos\");
            carregaFrame(\"".PATHPRINCIPAL."/frameveiculogrid/null\");"
        :

        (in_array($sNivelUsuario, array('GERENCIA'/*, 'USUÁRIO GERENTE'*/)) ? 
            "carrega_eventos(\"".PATHPRINCIPAL."/jsoneventos\");
             $('#status').hide();"
            : 
            
            "$('#buttonAlertas').remove();
             $('#alertas').remove();

             $('#contGrid').hide();
             $('#gridButton').height('2%');
             $('#gridButton').css({'width':'98%', 'right':'1.5%'})
             $('#topGrid').height('30%');
             $('#escondeGrid').hide();
             $('#apareceGrid').show();
             $('#tlcli_id').val('".$_SESSION[SESSAOEMPRESA]['usr_id']."', 'selected');
                 
             carregaFrame(\"".PATHPRINCIPAL."/frameveiculogrid/null\");"));

        $script = "
            <script type=\"text/javascript\">
                //-----  Variáveis
                var g = google.maps;
                var map, map_cerca, map_rota, map_trajeto;
                var arrMarkers		= [];
                var arrInfoWindows	= [];
                var pontos              = [];

                //-----  Inherits from OverlayView from the Google Maps API
                inherit(Tooltip, g.OverlayView);

                $(document).ready(function() {
                    $('#filtroVeiculo').hide();
                    
                    if($(window).width() > 1024){
                        $(\"#filtroVeiculo\").css({'margin-left':'30%', 'margin-top':'11%'});
                    }else{
                        $(\"#filtroVeiculo\").css({'margin-left':'27%', 'margin-top':'21%'});
                    }

                    $('#filtroVeic').click(function () {
                        if($('#filtroVeiculo').is(':visible')) {
                            $('#filtroVeiculo').hide();
                        } else {
                            $('#filtroVeiculo').show();
                        }
                    });

                    $('#tlcli_id').change(function(){
                        loading('');
                        
                        $.ajax({
                            url: \"".PATHPRINCIPAL."/cliente/lic/\"+this.value,
                            success: function(data){
                                $('#tlinst_id').html(data);
                                fecharLoandig();
                            }
                        });
                    });

                    $('#popupUsu').hide();
                    
                    $('#user_td').hover(function () {
                       $('#popupUsu').show();
                    });
                    
                    $('#map_canvas').hover(function () {
                       $('#popupUsu').hide();
                    });

                    $('#sairBtFechar').click(function () {
                       $('#popupUsu').hide();
                    });

                    $('a[name=modal]').click(function(e) {
                        e.preventDefault();

                        var id = $(this).attr('href');
                        var maskHeight = $(document).height();
                        var maskWidth = $(window).width();

                        $('#mask').css({'width':maskWidth,'height':maskHeight});
                        $('#mask').fadeIn(800);	
                        $('#mask').fadeTo(\"slow\",0.95);

                        //Get the window height and width
                        var winH = $(window).height();
                        var winW = $(window).width();

                        $(id).css('top',  winH/2-$(id).height()/2);
                        $(id).css('left', winW/2-$(id).width()/2);

                        $(id).fadeIn(2000); 
                        
                        $('#apareceAl').show();
                        $('#escondeAl').hide();
                        $('#alertas').width('3.5%');   

                        $('#contGrid').hide();
                        $('#gridButton').height('2%');
                        $('#gridButton').css({'width':'95%', 'right':'4.5%'})
                        $('#topGrid').height('30%');
                        $('#escondeGrid').hide();
                        $('#apareceGrid').show(); 

                    });

                    $('.window').click(function (e) {
                        e.preventDefault();
                        $('#mask').hide();
                        $('.window').hide();
                        document.getElementById('cadContainer').innerHTML = '';
                        //carregaFrame(ActiveUrl);
                    });		

                    $('#close').click(function () {
                        $('#mask').hide();
                        $('.window').hide();
                        document.getElementById('cadContainer').innerHTML = '';
                        carregaFrame(ActiveUrl);
                    });                    
                    
                    $(\"#apareceAl\").hide();
                    $(\"#escondeAl\").click(function() {
                        $(\"#apareceAl\").show();
                        $(\"#escondeAl\").hide();
                        $(\"#alertas\").width('3.5%'); 
                        $('#gridButton').css({'width':'95%', 'right':'4.5%'})
                        $('#rodapeGrid').css({'width':'95%'})
                        $('#rodape_3').css({'width':'30%'})
                        
                        $('.grid').css(\"width\", \"1280px\");
                        $(\".dataTables_wrapper\").css({width:1280, height:120, 'margin-top':'0px'});
                    }); 
                    
                    $(\"#apareceAl\").click(function() {
                        $(\"#escondeAl\").show();
                        $(\"#apareceAl\").hide();
                        $(\"#alertas\").width('200px'); 
                        $('#gridButton').css({'width':'80%', 'right':'21%'})
                        $('#rodapeGrid').css({'width':'77%'})
                        $('#rodape_3').css({'width':'23%'})
                        
                        $('.grid').css(\"width\", \"1024px\");
                        $(\".dataTables_wrapper\").css({width:1024, height:120, 'margin-top':'0px'});
                    });

                    $(\"#apareceGrid\").hide();
                    
                    $(\"#escondeGrid\").click(function() {
                        $(\"#contGrid\").hide();
                        $(\"#gridButton\").height('2%');
                        $(\"#escondeGrid\").hide();
                        $(\"#apareceGrid\").show();
                    });
                    
                    $(\"#apareceGrid\").click(function() {
                        $(\"#gridButton\").height('40%');
                        $(\"#contGrid\").show();

                        $(\"#topGrid\").height('7%');
                        $(\"#escondeGrid\").show();
                        $(\"#apareceGrid\").hide();
                        $(\"#field\").click();
                    });

                    //-----  Google Maps
                    var latlng = new g.LatLng(-8.02304, -34.8622);	//-----  Coordenadas para Centralizar o Mapa
                    var myOptions = {
                        zoom: 5,
                        center: latlng,
                        scaleControl: true,
                        mapTypeId: tipomapa
                    };

                    $(\"#escondeGrid\").click();

                    map	= new g.Map(document.getElementById('map_canvas'), myOptions);

                    new Tooltip({map: map});
                    
                    var md_control = new MDControl();

                    var geocoder = new g.Geocoder();
                    
                    //-----  Colocar pontos no Mapa
                    $.getJSON(pathdefault+'/jsonponto',{}, function(data){
                        var ulPontos = '';

                        $.each(data.jmarkers, function(i, item){
                            item.pt_lat  = parseFloat(item.pt_lat);
                            item.pt_long = parseFloat(item.pt_long);
                            item.pt_raio = parseInt(item.pt_raio);

                            var posicao	 = new g.LatLng(item.pt_lat, item.pt_long);
                            var image	 = new g.MarkerImage(item.icone);
                            var endPonto = item.goop_ender;

                            var marker = new g.Marker({
                                    position: posicao,
                                    icon: image,
                                    map: map,
                                    title: item.pt_dsc,
                                    optimized: false,
                                    id : i
                            });

                            marker.setPosition(posicao);

                            //-----  Endereço do ponto
                            if (endPonto == '' || endPonto == null){
                                geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            endPonto = results[0].formatted_address;
                                        }else{
                                            endPonto = 'Não é possível determinar o endereço neste local.';
                                        }
                                    }else{
                                        endPonto = 'Não é possível determinar o endereço neste local.';
                                    }
                                });
                            }

                            var circulo = new g.Circle({
                                    strokeColor: '#FF0000',
                                    strokeOpacity: 0.8,
                                    strokeWeight: 2,
                                    fillColor: '#FF0000',
                                    fillOpacity: 0.35,
                                    map: map,
                                    radius: item.pt_raio
                            });                            

                            circulo.bindTo('center', marker, 'position');

                            arrMarkers[i] = item.ptic_dsc;
                            pontos.push(marker);

                            var infowindow = new g.InfoWindow({
                                content: '<h3>'+item.pt_dsc+'</h3><p>Lat: '+item.pt_lat+'<br />Long: '+item.pt_long+'<br />Raio: '+item.pt_raio+'m <br/>Endereço: '+endPonto+'</p>'
                            });

                            arrInfoWindows[i] = infowindow;
                            arrInfoWindows.push(infowindow);

                            g.event.addListener(marker, 'click', function(){
                                $(\"#escondeAl\").click();
                                $(\"#escondeGrid\").click();
                                map.setZoom(16);
                                infowindow.open(map, marker);
                            });                            
                            map.setCenter(posicao);
                        });         
                    })
                    .complete(function(){
                        map.setZoom(6);
                        $('#status').hide();
                    })
                    .error(function(){ location.reload(); });
                    
                    ".$carregaEventos."
                    
                    $('span.TipoMapa').css({
                        'height' : '20px',
                        'background-color' : '#ccc',
			'font-size': '12px',
			'position': 'absolute',
			'left': '100px',
			'top': '40px',
			'z-index': '5'
                    }).styledButton({
                        'orientation' : 'alone',
                        'dropdown' : { 'element' : 'ul' },
                        'role' : 'select',
                        'defaultValue' : 'default value',
                        'clear' : true
                    });
                    
                    $('span.PontosMapa').attr('disabled', false).css({
                        'height' : '20px',
                        'background-color' : '#ccc',
                        'font-size': '12px',
                        'position': 'absolute',
                        'left': '170px',
                        'top': '40px',                        
                        'z-index': '5'
                    }).styledButton({
                        'orientation' : 'alone',
                        'dropdown' : { 'element' : 'ul' },
                        'role' : 'select',
                        'defaultValue' : 'default value',
                        'clear': true
                    });

                    $('.onlyMakersGroup').css({
                        'float' : 'left',
                        'margin-left' : '5px',
                        'font-size' : '10px',
                        'text-decoration' : 'nome'
                    }).click(function(){
                        for (var i=0; i<arrMarkers.length; i++) {                            
                            if (arrMarkers[i] == this.id) {
                                pontos[i].setVisible(!pontos[i].getVisible());
                                if (pontos[i].getVisible()==true)
                                    $('#'+this.id).html(\"<img src='imagens/enter.gif' width='12' height='12' />&nbsp;\"+this.title);
                                else    
                                    $('#'+this.id).html(\"<img src='imagens/cancel.gif' width='12' height='12' />&nbsp;\"+this.title);
                            }
                        }
                    });
                });
            </script>";
        
        $sConteudo .= $script;
        $sConteudo .= $this->rodapeSistema();

        $this->setConteudo($sConteudo);
        
    }
}

?>