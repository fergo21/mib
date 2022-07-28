const actionAlertPrompt = (icon, title, text, url = null) => {
    swal({
        icon: icon,
        title: title,
        text: text,
        buttons: {
            cancel: "No",
            catch: {
                text: "Continuar",
                value: "ok",
            }
        },
    })
    .then((value) => {
      switch (value) {
        case "ok":
          //Redirigir
          window.location.href = homeUrl + url;
          break;
        default:
          //swal("Got away safely!");
          break;
      }
    });
}
const deleteItem = (element, table) => {
    event.preventDefault();
    actionDeletAlert(function(data){
        if(data){
            let url = $(element).attr('href');
            actionAjax(url, 'GET', table);
        }
    })
}
const actionAlert = (title, status) => {
    swal(title, {
        icon: status,
    });
}
const actionDeletAlert = (callback) => {
    swal({
      title: "¿Estás seguro?",
      text: "Estás por eliminar un registro y todo lo asociado a él.",
      icon: "warning",
      buttons: ["No", true],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        callback(willDelete);
      }
    });
}

const actionAjax = (url, method, table_id, data = null) => {
    $.ajax({
        url: url,
        method: method,
        data: data,
        complete: function(){
            if(['divisions-grid', 'years-grid', 'products-grid'].includes(table_id)){
                $.fn.yiiGridView.update(table_id);
            }else{
                window.location.reload();
            }
            // closeLoading(); 
        }
    }).done(function(data){
        let response = JSON.parse(data);
        if(response.status){
            actionAlert("Registro eliminado", "success");
        }else{
            actionAlert("Error. No se pudo completar la acción.", "error");
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
        actionAlert("Error. No se pudo completar la acción.", "error");
        console.log(`${textStatus}: ${errorThrown}`);
    })
}


$(document).ready(function(){
    $("nav a").each((i,el)=>{
        if(el.getAttribute("href") == window.location.pathname){
            $(el).addClass("mdl-navigation__link--current");
        }else{
            $(el).removeClass("mdl-navigation__link--current");
        }
    });

    if($('.mdl-data-table tbody tr td').hasClass('empty')){
        $('.mdl-data-table tbody tr').remove();
    }
   let table = $('.mdl-data-table:not(.table-products-selected)').DataTable({
        "order": [],
        "responsive": true,
        "autoWidth": false,
        "retrieve": true,
        "stateSave": false,
        "language": {
            lengthMenu: 'Mostrar _MENU_ registros por página',
            zeroRecords: 'Sin resultados',
            info: 'Página _PAGE_ de _PAGES_',
            infoEmpty: 'Sin registros',
            infoFiltered: '(filtrado desde _MAX_ total de registros)',
            paginate: {
              previous: "<",
              next: ">"
            },
            search: "Buscar:"
        },
    });
   const searchData = () => {
       // Filtro para tabla
        $("form input[type='text'], form select").each(function(index,el) {
            //$(this).on('keyup', function () {
                column = table.column(index);
                if (column.search() !== this.value) {
                    column
                        .search(this.value)
                        .draw();
                }
            // });
        });    
   }

   $('.search-form form').submit(function(e){
        e.preventDefault();
        searchData();
    });
   $('.search-form .actionClear').click(()=>{
        $('.search-form form').trigger('reset');
        searchData();
   });

   $("#downloadFile").click(function(e){
    e.preventDefault();
       if($(".mdl-card form #Schools_name").val() && $(".mdl-card form #Promos_year_promo").val() && $(".mdl-card form #Years_year").val() 
        && $(".mdl-card form #Divisions_division").val() && $(".mdl-card form #Shifts_shift").val()){

            let data = `${$(".mdl-card form #Schools_name").val()} - ${$(".mdl-card form #Years_year").val()} - ${$(".mdl-card form #Divisions_division").val()} - ${$(".mdl-card form #Shifts_shift").val()} - ${$(".mdl-card form #Promos_year_promo").val()}`;
            
            $(".mib-actions form input#downloadFileData").val(data);
            $(".mib-actions form").trigger('submit');
       }else{
            actionAlert("Debe ingresar datos de la Escuela, Promo, Curso, División y Turno en Búsqueda avanzada.", "warning");
       }
   });

   $('.grid-view input[type="search"]').addClass('mdl-textfield__input');
   $('.grid-view select').addClass('mdl-selectfield__select select2');


    $('.select2').select2();
    $('.select2-container').css('width','100%');

    $(".disclaimer").css("display","none");

    
    let param = [];
    let idx = 0;
    let dataResponseProduct = 0;
    let total = 0.0;

    let listProduct = $("#Orders_size").val() === "" || $("#Orders_size").val() === undefined ? "" : JSON.parse($("#Orders_size").val());

    const validateListProduct = (listProduct) => {
        if(typeof listProduct == 'object'){
            parseDataTable(listProduct);
        }
    }

    const parseDataTable = (list) => {
        
        postCombo(list, function(data){
            $.each(list, function(i, item) {
                list[i]['unitPrice'] = data.products.find(p=>p.i === item.idproducts)?.unitPrice;
            });
            //renderizo la tabla
            renderTable(list);
            // Resetea el formulario
            $("#Orders_size").val(JSON.stringify(list));
        });
        
    }

    const renderTable = (list, editable=true) => {
        let trHTML = '';
        $.each(list, function(i, item) {
             trHTML += `<tr data-id="${i}">
                        <td class="mdl-data-table__cell--non-numeric">${item.product}</td>
                        <td class="mdl-data-table__cell--non-numeric">${item.quantity}</td>
                        <td class="mdl-data-table__cell--non-numeric">${item.talles}</td>
                        <td class="mdl-data-table__cell--non-numeric">${item.apodo}</td>
                        <td class="mdl-data-table__cell--non-numeric">${item.unitPrice}</td>
                        ${editable ? '<td class="mdl-data-table__cell--non-numeric deleteTr"><i class="material-icons">delete_forever</i></td>' : ''}
                    </tr>`;
        });
        $('#mib-tbody').html(trHTML);
    }

    const formatRepo = (data) => {
        data.map((item)=>{
            $(`#data-school`).html(`${item.school}`);
            $(`#data-city`).html(`${item.city}`);
            $(`#data-year`).html(`${item.year}`);
            $(`#data-division`).html(`${item.division}`);
            $(`#data-shift`).html(`${item.shift}`);
            $(`#data-year_promo`).html(`${item.year_promo}`);
            $(`#data-image_promo`).attr("src", `${item.image_promo}`);
        });
    }

    const postCombo = (param, callback) => {

        //Y aca se va a guardar el resultado
        let result = [];

        // Recorro el array elemento por elemento
        param.forEach(function (a) {
            
            // Me fijo si el elemento que voy a cargar ya existe, si no existe, lo creo con dinero en 0
            if (!this[a.idproducts]) {
                this[a.idproducts] = { idproducts: a.idproducts, quantity: 0};
                result.push(this[a.idproducts]);
            }
            // Y luego le sumo el quantity (en el caso que ya exista, no se crea, solo se le suma el quantity)
            this[a.idproducts].quantity += parseInt(a.quantity);
        // Como segundo argumento de la funcion del foreach paso [] para que retorne un array.
        }, []);
        // console.log(result);
        $.ajax({
            url: `${homeUrl}/orders/getCombos`,
            dataType: 'json',
            type: 'POST',
            data: {q: JSON.stringify(result), p: $("#Orders_percent").val()}
        })
        .done(function(data){
            $('#Orders_total_amount').parent().addClass('is-dirty');
            $('#Orders_total_amount').val(data.total);
            param = [];
            callback(data);
        })
        .fail(function(err){
            $('#Orders_total_amount').val('');
            $('#Orders_total_amount').parent().removeClass('is-dirty');
            param = [];
            return err;
        });
    }
    
    const resetForm = (id) => {
        $(`${id}`).trigger("reset"); //Line1
        $(`${id} select`).trigger("change"); //Line2
    }

    const formatTicket = (order) => {
        $("#ticket_dues_paid .mdl-list").html("");
        let signo = order.saldo > 0 ? "↑" : "↓";

        $("#total_order").val(order.total_amount);
        $("#Tickets_code").val(order.code);
        $("#Tickets_code").parent().addClass("is-dirty");
        $("#saldo_ticket").attr("data-saldo",order.saldo);
        if(order.saldo > 0){
            $("#saldo_ticket").html(`Saldo: $ ${order.saldo} ${signo}`);
            $("#saldo_ticket").addClass('green');
        }else if(order.saldo < 0){
            $("#saldo_ticket").html(`Saldo: $ ${order.saldo} ${signo}`);
            $("#saldo_ticket").addClass('red');
        }
        let checkbox = "";
        for(let i = 1; i <= order.dues; i++){
            if(i <= order.ticket.dues_paid){
                createCheckbox('ticket_dues_paid', i, true, `${i}° cuota pagada`, true);
            }else{
                createCheckbox('ticket_dues_paid', i, false, `${i}° cuota`, false);
            }
        }
    }

    const createCheckbox = (containerId, item, checked, label, disabled) => {
        const toDoList = document.querySelector(`#${containerId} ul.mdl-list`);
        //create list item
        let newLi = document.createElement('li');  
        newLi.classList.add('mdl-list__item', 'newMdl');


        //create checkbox and attach to primary span container
        let toDoLabel = document.createElement('label');
        toDoLabel.classList.add('mdl-checkbox', 'mdl-js-checkbox', 'mdl-js-ripple-effect', `checkbox--colored-${disabled ? 'green' : 'orange'}`, 'newMdl');
        toDoLabel.htmlFor = `list-checkbox-${item}`;

        //create primary span
        let toDoSpan = document.createElement('span');
        toDoSpan.classList.add('mdl-checkbox__label', 'newMdl');
        
        let checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = `list-checkbox-${item}`;
        checkbox.classList.add('mdl-checkbox__input', 'newMdl');
        checkbox.checked = checked;
        checkbox.disabled = disabled;
        checkbox.dataset.due = item; 


        //create text and attach to primary span container
        let labelText = document.createTextNode(`${label}`); 
 
        toDoLabel.appendChild(checkbox);
        newLi.appendChild(toDoLabel);
        toDoLabel.appendChild(toDoSpan);
        toDoSpan.appendChild(labelText);

        //add list item to to-do list
        toDoList.appendChild(newLi);


        let mdlElemets = document.querySelectorAll(".newMdl");
        componentHandler.upgradeElements(mdlElemets);
        
        if(disabled){
            toDoLabel.classList.remove('is-disabled');
        }
    }

    const changePaid = () => {
        let paid = $("#Tickets_paid").val();
        let amount = $("#Tickets_amount").val();
        paid = paid.replace(",", ".");

        let vuelto = paid ? formatPrice(parseFloat(paid) - parseFloat(amount)) : 0.00;

        vuelto = vuelto ? vuelto : 0.00;

        $("#Tickets_paid").val(paid);
        $("#vuelto_ticket").html(`Vuelto/saldo: $ ${vuelto}`);
        if($("#save_saldo")[0].checked){
            $("#Tickets_saldo").val(vuelto);
        }
    }

    validateListProduct(listProduct);

    $("#Orders_percent").on("keyup", function(){
        $(this).val($(this).val().replace(",", "."));
        if(listProduct!==""){
            validateListProduct(listProduct);
        }
    })

    $(".mdl-grid.dialog .mdl-cell select:first").change(function(){
        if($(".mdl-grid.dialog .mdl-cell select:first option:selected").text().toLowerCase().includes("panta")){
            $(".product-ltar").hide();
            $(".product-ltab").show();
            $("#order-product-apodo").parent().hide();
        }else{
            $(".product-ltar").show();
            $(".product-ltab").hide();
            $("#order-product-apodo").parent().show();
        }
    })

    $(".add-product").click(function(){
        let validateField = 0;
        $(".errorForm").html("");
        $("form#formAddProduct .mib-field:visible").each((i,e)=>{ 
            if(e.value == "" || e.value == "Seleccionar"){
                validateField = validateField + 1;
            }
        })

        if(validateField == 0){
            listProduct = [...listProduct,{
                idproducts: $(".mdl-grid.dialog .mdl-cell select")[0].value, 
                product: $(".mdl-grid.dialog .mdl-cell select:first option:selected")[0].text,
                quantity: $(".mdl-grid.dialog .mdl-cell input")[0].value,
                talles: $(".mdl-grid.dialog .mdl-cell .mdl-selectfield:visible select")[1].value,
                apodo: $(".mdl-grid.dialog .mdl-cell input")[1].value
            }];
            // Cierra el modal
            closeModal();
            // Renderiza la tabla
            parseDataTable(listProduct);
            // Resetea el formulario
            // $("#Orders_size").val(JSON.stringify(listProduct));
            resetForm("#formAddProduct");
        }else{
            $(".errorForm").html("Todos los campos son requeridos.");
        }
    })

    $('body').on('click', 'td.deleteTr', function() {

        let index = parseInt($(this).parents('tr').attr('data-id'));

        listProduct = listProduct.filter(function(item, i){
            return i !== index
        });
        $("#Orders_size").val(JSON.stringify(listProduct));
        parseDataTable(listProduct);
    });

    //Get Estudiante
	$('.select-student.select2').select2({
        language: {
            searching: function() {
                return "Buscando...";
            },
            errorLoading: function() {
                return "No se pudieron cargar los resultados.";
            },
            noResults: function() {
                return "No se han encontrado resultados.";
            }
        },
        ajax: {
            url: `${homeUrl}/students/getStudents`,
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
            		var res = data.map(function (item) {
                    	return {id: item.idstudents, text: `${item.name} ${item.surname}`};
                    });
                return {
                    results: res
                };
            },
            success: function (data){
                $("#Orders_date_delivery").val(data[0].date_delivery);
                formatRepo(data)
            }
        }
    });
    // Fetch the preselected item, and add to the control
    var studentSelect = $('.select-student.select2');
    let s_ci = $('.select-student.select2').attr('data-ci');
    if(s_ci){
        $.ajax({
            type: 'POST',
            url: `${homeUrl}/students/getStudents`,
            data: { q: s_ci }
        }).then(function (data) {
            let data_s = JSON.parse(data);
            // create the option and append to Select2
            var option = new Option(`${data_s[0].name} ${data_s[0].surname}`, data_s[0].idstudents, true, true);
            studentSelect.append(option).trigger('change');
            
            if(window.location.pathname.includes("create")){
                $("#Orders_date_delivery").val(data_s[0].date_delivery);
            }
            formatRepo(data_s);
            // manually trigger the `select2:select` event
            studentSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });
        });
    }
    let dataOrder = {};
    // GET Orden
    $('.select-orders.select2').select2({
        language: {
            searching: function() {
                return "Buscando...";
            },
            errorLoading: function() {
                return "No se pudieron cargar los resultados.";
            },
            noResults: function() {
                return "No se han encontrado resultados.";
            }
        },
        ajax: {
            url: `${homeUrl}/orders/getOrders`,
            dataType: 'json',
            type: "POST",
            delay: 250,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                    var res = data.map(function (item) {
                        return {id: item.value, text: item.label};
                    });
                return {
                    results: res
                };
            },
            success: function (data){
                dataOrder = data;
            }
        }
    }).on("change", function(e){
        // console.log(dataOrder, e.target.value);
        formatTicket(dataOrder.find(order => order.value == e.target.value));
        renderTable(JSON.parse(dataOrder[0].description), false);
        // console.log(dataOrder);
    });

    $("#Tickets_form_payment").change(function(){
        let total = $("#Tickets_amount").val();
        let newTotal = $("#Tickets_amount").attr("data-amount");
        let form_payment = $("#Tickets_form_payment").val();
        if(total && form_payment == "CC"){
            newTotal = calculateTotal(total, true);
        }
        $("#Tickets_amount").val(formatPrice(newTotal));
    });
    
    $("#Tickets_paid").keyup(function(){
        changePaid();
        // let paid = $(this).val();
        // let amount = $("#Tickets_amount").val();
        // paid = paid.replace(",", ".");

        // let vuelto = paid ? formatPrice(parseFloat(paid) - parseFloat(amount)) : 0.00;

        // vuelto = vuelto ? vuelto : 0.00;

        // $(this).val(paid);
        // $("#vuelto_ticket").html(`Vuelto/saldo: $ ${vuelto}`);
        // if($("#save_saldo")[0].checked){
        //     $("#Tickets_saldo").val(vuelto);
        // }
    });

    $("#ticket_dues_paid").on("change", "input", function(){
        let dues_paid_checked = $("#ticket_dues_paid input:checked").last()[0]?.getAttribute("data-due");
        let lastDue = dues_paid_checked ? parseInt(dues_paid_checked) - 1 : 0;

        for (let i = lastDue; i > 0; i--) {
            $(`#ticket_dues_paid input#list-checkbox-${i}`).prop("checked",true).parent().addClass("is-checked");
        }

        let cantidad_cuota = $("#ticket_dues_paid input").length;
        let cantidad_cuota_seleccionada = $("#ticket_dues_paid input:checked:not(:disabled)").length;
        let saldo = $("#saldo_ticket").attr("data-saldo") ? $("#saldo_ticket").attr("data-saldo") : 0;

        let dues_ticket = [];

        let total = parseFloat($("#total_order").val());
        let total_cuota = total / cantidad_cuota;
        
        let valor_cuota_pagar = cantidad_cuota_seleccionada ? (total_cuota * cantidad_cuota_seleccionada) - saldo : 0;
        
        $("#Tickets_amount").attr("data-amount", formatPrice(valor_cuota_pagar));

        if($("#Tickets_form_payment").val() == "CC"){
            valor_cuota_pagar = calculateTotal(valor_cuota_pagar, true);
        }

        //seteo todos los anteriores 

        $("#ticket_dues_paid input:checked").each(function(i,e){
            dues_ticket.push(e.getAttribute("data-due"));
        });

        $("#Tickets_dues").val(dues_ticket.join());
        $("#Tickets_amount").val(formatPrice(valor_cuota_pagar));
        $("#Tickets_amount").parent().addClass("is-dirty");
        changePaid();
    });

    $("#save_saldo").change(function(){
        if($(this)[0].checked){
            let regex = /(-)(\d+)/g;
            let saldo = $("#vuelto_ticket").html().split("$")[1];
            $("#Tickets_saldo").val(saldo.replace(" ", ""));
        }else{
            $("#Tickets_saldo").val(0.00);
        }
    });

    const loadSelectStudents = (id, data = null) => {
        //Recargo los selects
        if(data){
            $(`.select2${id}`).select2({
                data: data
            });
        }else{
            $(`.select2${id}`).val(null).empty().select2('destroy');
            $(`.select2${id}`).select2({
                data: [{id: '0', text: 'Seleccionar'}]
            });
        }
    }

    $("#Students_idschools, #Students_idyears, #Students_iddivision, #Students_idshifts").change(function(){
        //Cada vez que cambia algun selector de estudiantes relacionado a la escuela y promos
        let result = {
            idschools: $("#Students_idschools").val(),
            idyears: $("#Students_idyears").val(),
            iddivision: $("#Students_iddivision").val(),
            idshifts: $("#Students_idshifts").val()
        }
        $.ajax({
            url: `${homeUrl}/promos/getPromos`,
            dataType: 'json',
            type: 'POST',
            data: {q: JSON.stringify(result)}
        })
        .done(function(data){
            if(data.length > 0){
                loadSelectStudents("#Students_graduation_year", data[0].promo);
                loadSelectStudents("#Students_idyears", data[0].curso);
                loadSelectStudents("#Students_iddivision", data[0].division);
                loadSelectStudents("#Students_idshifts", data[0].turno);
            }else{
                loadSelectStudents("#Students_graduation_year", null);
                loadSelectStudents("#Students_idyears", null);
                loadSelectStudents("#Students_iddivision", null);
                loadSelectStudents("#Students_idshifts", null);
            }
        })
        .fail(function(err){
            console.log(err);
        })
    });

    $("#Products_price, #Orders_total_amount, #Orders_advance_payment, #Tickets_amount, #Tickets_paid").on('input',function(){
        $(this).val(function(index,value){
            return value.replace(/\D/g, "")
            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, "");
        });
    })

    $('.button-year').click(function(){
        $('#content-year').show();
        openModal();
    });

    $('.close-year').click(function(){
        $('#content-year').hide();
        closeModal();
    });

    $('.button-division').click(function(){
        $('#content-division').show();
        openModal();
    });

    $('.close-division').click(function(){
        $('#content-division').hide();
        closeModal();
    });

    $('.show-dialog').click(function(){
        openModal();
    });

    $('#show-dialog-promo').click(function(){
        resetForm("#promos-form");
        $("form#promos-form").attr("action",`${homeUrl}/promos/create`);
        $("form .title-promo").html("Crear promo");
        $("form #data-image_promo").attr("src", "");
        openModal();
    });

    $('.mdl-dialog .close').click(function(){
        closeModal();
    });

    $("#Tutores_ci").on('keyup', function(){
        let ci_tutor = $("#Tutores_ci").val();
        if(ci_tutor.length >= 7){
            $.ajax({
                url: `${homeUrl}/tutores/getTutor`,
                dataType: 'json',
                type: 'POST',
                data: {q: ci_tutor}
            })
            .done(function(data){
                $("#Tutores_name").val(data.name);
                $("#Tutores_surname").val(data.surname);
                $("#Tutores_phone").val(data.phone);
                $("#Tutores_mail").val(data.mail);
            })
            .fail(function(err){
                console.log(error);  
            });
        }
    });

    const closeModal = () => {
        $('.mdl-dialog').hide();
        $('.mib-background-modal').hide();
    }

    const openModal = () => {
        $('.mdl-dialog').show();
        $('.mib-background-modal').show();
    }

    const calculateTotal = (total, applied) => {
        let t = parseFloat(total);
        if(applied){
            return t + (t * settingJson['percent_cc']);
        }else{
            return t - (t * settingJson['percent_cc']);
        }
    }
    const formatPrice = (price) => {
        if(price){
            return parseFloat(price).toFixed(2);
        }
    }
});