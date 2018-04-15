$(function(){

    //var dat_por;
    //var dat_mod;
    //var dat_res;

    //var val_por;
    //var val_mod;
    //var val_res;

    var t_s_por;
    var t_s_mod;
    var amp_por;
    var frec_por;
    var frec_mod;

    modulaciones= { 
        1:"/sisisea/back/mod_fm/obt_mod_signals_fm.php",
        2:"/sisisea/back/mod_fm/obt_mod_signals_pm.php",
    };

    $('select').material_select();

    $('#btn_portadora').on('click',function(){
        
        var dat_por;
        var val_por;

        amp_por = $('#amplitud_c').val();
        frec_por = $('#frecuencia_c').val();
        t_s_por = $('select[id=t_portadora]').val();
        var t_ini_por = $('#t_inicial_por').val();
        var t_fin_por = $('#t_final_por').val();

        dat_por = { 
            amplitud:amp_por,
            frecuencia:frec_por,
            t_senal:t_s_por,
            t_inicial:t_ini_por,
            t_final:t_fin_por,
        };

        var datos = new Object();
        
        var espcio = (parseInt(parseInt(amp_por)/parseInt(10))); 
        
        if(espcio > 0){
            datos.max = (parseInt(amp_por)+(parseInt(1)*espcio));
        }else{
            datos.max = (parseInt(amp_por)+parseInt(1));
        }
        datos.min = -(datos.max);

        var cond_graf = ((t_fin_por-t_ini_por)*frec_por)*100;
        
        if(cond_graf<=2000){

        }

        $.ajax({
            url: '/sisisea/back/mod_fm/obt_bas_sig.php',
            type: 'POST',
            data: JSON.stringify(dat_por),
            dataType:'json',
            success: function(msg){
                //console.log('DESDE BOTON SUCCES: '+JSON.stringify(msg));
            },
        }).done(function(msg){
            val_por = {
                type: 'line',
                data: {
                    labels: msg.etiquetas,
                    datasets: [{
                        label: msg.tipo,
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: msg.valores,
                        radius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tiempo'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: datos,
                            scaleLabel: {
                                display: true,
                                labelString: 'Voltios'
                            }
                        }]
                    },
                    elements:{ 
                        point:{ 
                            radius: 0 
                        } 
                    }
                }
            };
            var ctx1 = $('#canvas_portadora')[0].getContext('2d');
            $.myLine = new Chart(ctx1, val_por);
        });   
    });
    
    $('#btn_moduladora').on('click',function(){
        
        var dat_mod;
        var val_mod;
        
        var amp_mod = $('#amplitud_m').val();
        frec_mod = $('#frecuencia_m').val();
        t_s_mod = $('select[id=t_moduladora]').val(); 
        var t_ini_mod = $('#t_inicial_mod').val();
        var t_fin_mod = $('#t_final_mod').val();

        dat_mod = { 
            amplitud:amp_mod,
            frecuencia:frec_mod,
            t_senal:t_s_mod,
            t_inicial:t_ini_mod,
            t_final:t_fin_mod,
        };
        
        var val_mod;

        var datos = new Object();
        var espcio = (parseInt(parseInt(amp_mod)/parseInt(10))); 
        
        if(espcio > 0){
            datos.max = (parseInt(amp_mod)+(parseInt(1)*espcio));
        }else{
            datos.max = (parseInt(amp_mod)+parseInt(1));
        }datos.min = -(datos.max);

        $.ajax({
            url: '/sisisea/back/mod_fm/obt_bas_sig.php',
            type: 'POST',
            data: JSON.stringify(dat_mod),
            dataType:'json',
            success: function(msg){
            //return msg;
            },
        }).done(function(msg){
            val_mod = {
                type: 'line',
                data: {
                    labels: msg.etiquetas,
                    datasets: [{
                        label: msg.tipo,
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: msg.valores,
                        radius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tiempo'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: datos,
                            scaleLabel: {
                                display: true,
                                labelString: 'Voltios'
                            }
                        }]
                    },
                    elements:{ 
                        point:{ 
                            radius: 0 
                        } 
                    }
                }
            };

            var ctx2 = $('#canvas_moduladora')[0].getContext('2d');
            $.myLine = new Chart(ctx2, val_mod);
        
        });

    });

    $('#btn_resultado').on('click',function(){
        
        var dat_res;
        var val_res;

        var t_modulacion = $('select[id=tipo_modulacion]').val();
        
        var t_ini_res = $('#t_inicial_res').val();
        var t_fin_res = $('#t_final_res').val();
        var ind_mod_res =$('#ind_mod_res').val();

        //var datos = '{ "username":"'+user+'" , "password" : "'+pass+'" }';

        dat_res = { 
            t_inicial: t_ini_res, 
            t_final: t_fin_res,
            t_signal_por:t_s_por,
            t_signal_mod:t_s_mod,
            ampC:amp_por,
            frecM:frec_mod,
            frecC:frec_por,
            ind_mod: ind_mod_res,
        };

        //console.log(modulaciones[t_modulacion]);//obtener valor del json. me falta

        var val_res;

        var datos = new Object();
        var espcio = (parseInt(parseInt(amp_por)/parseInt(10))); 
        
        if(espcio > 0){
            datos.max = (parseInt(amp_por)+(parseInt(1)*espcio));
        }else{
            datos.max = (parseInt(amp_por)+parseInt(1));
        }
        datos.min = -(datos.max);

        var val_esp;

        $.ajax({
            url: modulaciones[t_modulacion],
            type: 'POST',
            data: JSON.stringify(dat_res),
            dataType:'json',
            success: function(msg){
            //return msg;
            },
        }).done(function(msg){
            val_res = {
                type: 'line',
                data: {
                    labels: msg.etiquetas,
                    datasets: [{
                        label: msg.tipo,
                        fill: false,
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: msg.valores,
                        radius: 0,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tiempo'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: datos,
                            scaleLabel: {
                                display: true,
                                labelString: 'Voltios'
                            }
                        }]
                    },
                    elements:{ 
                        point:{ 
                            radius: 0 
                        } 
                    }
                }
            };

            var ctx3 = $('#canvas_resultado')[0].getContext('2d');
            $.myLine = new Chart(ctx3, val_res);

        });

    });

});