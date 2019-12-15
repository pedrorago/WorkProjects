$(document).ready(function() {

  $(".deleteIndex").on("click", function(){

    $(".ConfirmDelete").css('display', 'none');
    $(".ConfirmDelete").css('opacity', '0');

    $(this).siblings(".ConfirmDelete").css("display", "flex");
    var dis = $(this);
    setTimeout(function(){
      $(dis).siblings(".ConfirmDelete").css("opacity", "1");
    }, 300);


  });

  $(".buttonEditDelete").on("click", function(){

    $(".ConfirmDelete").css('display', 'none');
    $(".ConfirmDelete").css('opacity', '0');

    $(this).siblings(".ConfirmDelete").css("display", "flex");
    var dis = $(this);
    setTimeout(function(){
      $(dis).siblings(".ConfirmDelete").css("opacity", "1");
    }, 300);


  });





  $(".nDelete").on('click', function(){
    $(".ConfirmDelete").css('display', 'none');
    $(".ConfirmDelete").css('opacity', '0');
  });

  setTimeout(function(){
      $(".gradientModal").fadeIn();
      $(".ModalInfo").fadeIn();
  },2000 );


  $(".closeModalInfo").on("click", function(){

      $(".gradientModal").fadeOut();
      $(".ModalInfo").fadeOut();
    
  });




$('.formModal').submit(function(e) {
  e.preventDefault();
  var erro = false;

  const id = $('.user_id').val();
  console.log($('.formModal input[name="_token"]').val());
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('.formModal input[name="_token"]').val()
      },
      url: '/users/'+id+'/update', // caminho para o script que vai processar os dados
      type: 'patch',
      data: {id_user_modify: id},
      beforeSend: function () {

      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {
            $(".gradientModal").fadeOut();
            $(".ModalInfo").fadeOut();
          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 


//



  $('.issuesTable tr').bind("contextmenu",function(e){
    var id = $(this).find(".idIssue").text();
    var serve = $("#serve").val();

    $(".visuMenu").attr('href', serve+"/issues/"+id);
    return false;
});

// Block right click
  
$(".issuesTable tr").mousedown(function(e){ 
  if( e.button == 2 ) {
      
      
      var subject = $(this).find('.NameTD a').text();
      var status = $(this).find('.TdStatus').text();
      var id = $(this).find('.TdID').text();
      var fullSubject = $(this).find('.NameTD a').text();
      var user = $('.custom-menu').find('.user').val();
      if(subject.length > 23)
      {
          subject = subject.substr(0, 20);
          subject = subject+'...';
      }
      
      $('.custom-menu').finish().show(100).
      // In the right position (the mouse)
      css({
          top: event.pageY + "px",
          left: event.pageX + "px"
      });
      
      
      $(".ListLink").one('click', function(e)
      {
          e.preventDefault();
          $(".notTasks").remove();
          var radio = document.createElement('span');
          radio.className = 'inputRadio';
          radio.onclick = function() {
              $(this).toggleClass('inputRadioActive');
              $(this).siblings('.actionTasks').toggleClass('actionTasksActive');
          }
          var trash = document.createElement('button');
          trash.className = 'editButton';
          trash.onclick = function() {
              $(this).closest('li').fadeOut();
              var pai = $(this).closest('li');
              tasksArray.splice(tasksArray.indexOf(pai.find(".id_issue").val()), 1);
              setTimeout(function()
              {
                  pai.remove();
                  
              }, 500);
              console.log(tasksArray);
          }
          var trashIcon = document.createElement('i');
          trashIcon.className = 'fas fa-trash';
          
          
          
          
          var li = $("<li class='ui-state-default ui-sortable-handle' title='"+fullSubject+"'><input type='hidden' class='subject' name='subject' value='"+fullSubject+"'> <input type='hidden' class='status' name='status' value='"+status+"'> <input type='hidden' class='id_issue' name='id_issue' value='"+id+"'><input type='hidden' class='user' name='id_user' value='"+user+"'><div class='actionTasks'> <a href='javascript:void(0)' class='btn btn-secondary btn-icon-split'> <span class='icon text-white-50'> <i class='fas fa-check'></i> </span> <span class='text'>Concluir Atividade</span> </a> </div> <p>"+subject+" <br/>"+status+"</p> </li>");
          
          // iconSpan.append(icon);
          // btnAdd.append(iconSpan);
          // btnAdd.append(btnText);
          // actionTasks.append(btnAdd);
          // edit.append(editIcon);
          // li.append(radio);
          // li.append(actionTasks);
          // li.append(p);
          // li.append(edit);
          li.prepend(radio);
          trash.prepend(trashIcon);
          li.prepend(trash);
          $("#sortable1").append(li);
          $(".tasksContent").addClass("tasksContentActive");
          li.css('box-shadow', '0 -2px 2px 0 rgba(118, 166, 208, 0.45), 0 2px 6px 2px rgba(118, 166, 208, 0.7)'); 
          
          setTimeout(function()
          {
              li.css('box-shadow', 'none'); 
              
          }, 1500);

          
      });
      
  } 
});


var divNome = document.querySelector(".custom-menu");
$(document).on("click", function(e) {
    var fora = divNome.contains(e.target);
    if(fora == false)
    {
    $(".custom-menu").hide(100);

    }
});

// $('.custom-menu').bind("mousedown", function (e) {
    
//     // If the clicked element is not the menu
//     if (!$(e.target).length > 0) {
        
//         // Hide it
//         $(".custom-menu").hide(100);
//     }
// });

// Hide menu



// If the menu element is clicked



  // Select DataTable

  var selectArray = [];

  // $("#dataTable tr").on("click", function(){
    
      
  
  // });

  // Menu Table

  var menu = [{
    name: 'create',
    img: 'images/create.png',
    title: 'create button',
    fun: function () {
        alert('i am add button')
    }
}, {
    name: 'update',
    img: 'images/update.png',
    title: 'update button',
    subMenu: [{
        name: 'merge',
        title: 'It will merge row',
        img:'images/merge.png',
        fun: function () {
            alert('It will merge row')
        }
    }, {
        name: 'replace',
        title: 'It will replace row',
        img:'images/replace.png',
        subMenu: [{
            name: 'replace top 100',
            img:'images/top.png',
            fun:function(){
            alert('It will replace top 100 rows');
            }

        }, {
            name: 'replace all',
            img:'images/all.png',
            fun:function(){
            alert('It will replace all rows');
            }
        }]
    }]
}, {
    name: 'delete',
    img: 'images/delete.png',
    title: 'delete button',
    subMenu: [{
        'name': 'soft delete',
        img:'images/soft_delete.png',
        fun:function(){
        alert('You can recover back');
        }
    }, {
        'name': 'hard delete',
        img:'images/hard_delete.png',
        fun:function(){
        alert('It will delete permanently');
        }
    }]

}];
 

$('.selected').contextMenu(menu);







//Enviando form 

var versions_value = '';

$(".labelVersions").on('click', function(){
  move_value = $(this).attr('for');
  $("#form_versios").submit();
  $(".custom-menu").hide(100);

});
  
$('#form_versios').submit(function(e) {
  e.preventDefault();
  var idRest = ' ';
  console.log('Aqui '+selectArray[0]);

  if(selectArray.length == 0)
  {
    idRest = $('.selected .idIssue').text();
  }else{
    for(var i = 0; i < selectArray.length; i++){
      idRest = idRest+' '+selectArray[i];
    }
  }

  const versions = move_value;
  const form = 'versions';
  const id = idRest;
  var erro = false;

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('#form_versios input[name="_token"]').val()
      },
      url: '/issues/update', // caminho para o script que vai processar os dados
      type: 'PUT',
      data: {versions: versions,form: form, id: id},
      beforeSend: function () {

      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {
              window.location.href = $("#url").val();
          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 


//


var priority_value = '';

$(".labelPriority").on('click', function(){
  priority_value = $(this).attr('for');
  $("#form_priority").submit();
  $(".custom-menu").hide(100);

});
  
$('#form_priority').submit(function(e) {
  e.preventDefault();
  var idRest = ' ';
  console.log('Aqui '+selectArray[0]);

  if(selectArray.length == 0)
  {
    idRest = $('.selected .idIssue').text();
  }else{
    for(var i = 0; i < selectArray.length; i++){
      idRest = idRest+' '+selectArray[i];
    }
  }

  const priority = priority_value;
  const form = 'priority';
  const id = idRest;
  var erro = false;

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('#form_priority input[name="_token"]').val()
      },
      url: '/issues/update', // caminho para o script que vai processar os dados
      type: 'PUT',
      data: {priority: priority,form: form, id: id},
      beforeSend: function () {

      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {
              window.location.href = $("#url").val();
          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 


//


var attr_value = '';

$(".labelAttr").on('click', function(){
  attr_value = $(this).attr('for');
  $("#form_attr").submit();
  $(".custom-menu").hide(100);

});
  
$('#form_attr').submit(function(e) {
  e.preventDefault();
  var idRest = ' ';
  console.log('Aqui '+selectArray[0]);

  if(selectArray.length == 0)
  {
    idRest = $('.selected .idIssue').text();
  }else{
    for(var i = 0; i < selectArray.length; i++){
      idRest = idRest+' '+selectArray[i];
    }
  }

  const attr = attr_value;
  const form = 'attr';
  const id = idRest;
  var erro = false;

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('#form_attr input[name="_token"]').val()
      },
      url: '/issues/update', // caminho para o script que vai processar os dados
      type: 'PUT',
      data: {attr: attr,form: form, id: id},
      beforeSend: function () {

      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {
              window.location.href = $("#url").val();
          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 



var status_value = '';
$(".labelMenuStatus").on('click', function(){
  status_value = $(this).attr('for');
  $("#form_status").submit();
  $(".custom-menu").hide(100);

});
  
$('#form_status').submit(function(e) {
  e.preventDefault();
  $(".selected").map(function(item, data){

    if(!selectArray.indexOf($(data).find(".idIssue").text()) > -1)
      {
        selectArray.push($(data).find(".idIssue").text());
      }
      console.log(selectArray);
  });
  var idRest = ' ';

  console.log('Aqui '+selectArray[0]);

  if(selectArray.length == 0)
  {
    idRest = $('.selected .idIssue').text();
  }else{
    for(var i = 0; i < selectArray.length; i++){
      idRest = idRest+' '+selectArray[i];
    }
  }

  const status = status_value;
  const form = 'status';
  const id = idRest;
  var erro = false;

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('#form_status input[name="_token"]').val()
      },
      url: '/issues/update', // caminho para o script que vai processar os dados
      type: 'PUT',
      data: {status: status,form: form, id: id},
      beforeSend: function () {

      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {
            
              window.location.href = $("#url").val();

          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 





//


  
  ///////// Checklist
  
  $(".checkbox").on('click', function()
  {
      var id = $(this).siblings("#id_checklist").val();
      var name = $(this).siblings("label").text();
      console.log(id);
      if($(this).is(':checked')) {
        // If checbkox is checked where click on input change.
        // Não funciona quando o eleemento é criado e a página não está atualizada.
        // Para resolver isso, posso colocar um onclick quando for criado o elemento. 
        var status = 'close';
        updateChecklist(id, status, name);
        
        console.log('Close');
      }else{
        var status = 'open';
        updateChecklist(id, status, name);
        console.log('Open');
      }

  });

    



  $(".list-items").sortable({
    connectWith: 'ul',
    update: function(event, ui) {
      //Run this code whenever an item is dragged and dropped out of this list
      var order = $(this).sortable('serialize');
    },
    helper: 'clone'
  });
  $("#deleteArea").droppable({
    accept: '.list-items > li',
    activeClass: 'dropArea',
    hoverClass: 'dropAreaHover',
    drop: function(event, ui) {
      var erro = false;

      var id = ui.draggable.find('#id_checklist').val();
      var name = ui.draggable.find('label').text();
      var token = $('#deleteArea input[name="_token"]').val();

      $.ajax({
        url: '/checklist_remove/'+id+'/'+name, // caminho para o script que vai processar os dados
        type: 'DELETE',
        data: {
          "id": id,
          "_token": token,
          "name": name,
      },
        beforeSend: function () {
            // $(".CreateNew button").text("Adicionando");         
        },   
        success: function(response) {
            if(response.match(/Existem campos em branco./)){
                erro = true;
              }
  
            if(erro == true)
            {
              
            }
            else
            {

              ui.draggable.remove();

            }
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    return false;

    }
  });
  
  $( ".list-items" ).disableSelection();
  



  
$('.CreateNew').submit(function(e) {
  e.preventDefault();

  const issue_id               = $('input[name="issue_id"]').val();
  const name               = $('textarea[name="name"]').val();
  const status               = 'open';

  var erro = false;

  $.ajax({
      url: '/checklist', // caminho para o script que vai processar os dados
      type: 'GET',
      data: {issue_id: issue_id, name: name, status: status},
      beforeSend: function () {
          $(".CreateNew button").text("Adicionando");         
      },   
      success: function(response) {
          if(response.match(/Existem campos em branco./)){
              erro = true;
            }

          if(erro == true)
          {
            
          }
          else
          {

            $(".CreateNew button").text("Adicionar");   
            $(".CreateNew textarea").val("");   
            $(".CreateNew textarea").focus();   

            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.className = 'checkbox';
            checkbox.onclick = function() {
              var id = $(this).siblings("#id_checklist").val();
              var name = $(this).siblings("label").text();
              console.log(id);
              if($(this).is(':checked')) {
                // If checbkox is checked where click on input change.
                // Não funciona quando o eleemento é criado e a página não está atualizada.
                // Para resolver isso, posso colocar um onclick quando for criado o elemento. 
                var status = 'close';
                updateChecklist(id, status, name);
                
                console.log('Close');
              }else{
                var status = 'open';
                updateChecklist(id, status, name);
                console.log('Open');
              }
            }

            var element = $('<li class="item" style="display: none"><input type="hidden" name="id" id="id_checklist" value="0"> <label for="">'+name+'</label> <span><i class="fas fa-check"></i></span> </li>');

            element.prepend(checkbox);
            $(".list-items").append(element);

            setTimeout(function()
            {
              element.show(500);
            }, 500);

          }
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
  });
  return false;
}); 




  /////////////////////////////////////////////
  
  
  
  $(".nameProject").on("keyup", function() {
    
    let first = $(this).val().toLowerCase();
    first = first.substr(0, 1);
    
    $(".orderingProject").val(first);
    
  });
  
  
  
  
  $("#searchProject").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    
    let first = $(this).val().toLowerCase();
    first = first.substr(0, 1);
    
    
    
    
    $(".BoxProjects").filter(function() {
      $(this).toggle($(this).find('p').text().toLowerCase().indexOf(value) > -1)
    });
    
    $(".titleOrigim").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(first) > -1)
    });
  });
  
  var teste = $('.descriptionBody').text();
  
  $(".descriptionBody").html(teste);
  
  
  $(".doingBox").each(function(){
    $(this).find('.commentBody').html($(this).find('.commentBody').text());
  });
  $("#justcreate").on('change', function()
  {
    $(".formSprintCreate").submit();
  });
  
  $("#activecreate").on('change', function()
  {
    $(".formSprintCreate").submit();
  });
  
  $(".buttonApenasEditar").on('click', function()
  {
    $(".formSprintCreate").submit();
  });
  
  
  $(".buttonContinuar").on('click', function()
  {
    $(".formSprintCreate").submit();
  });
  
  $('.boxAttrImg').on('mousemove', function(e){
    $(this).siblings('.boxAttr').fadeIn();
    $(this).siblings('.boxAttr').css('display', 'flex');
  });
  
  
  
  $('.boxAttrImg').on('mouseleave', function(e){
    $(this).siblings('.boxAttr').fadeOut();
  });
  
  
  $('.boxAttrImg').on('mousemove', function(e){
    $(this).find('.statusBox').fadeIn();
    $(this).find('.statusBox').css('display', 'flex');
  });
  
  
  $('.trStatus').on('mousemove', function(e){
    $(this).find('.statusBox').fadeIn();
    $(this).find('.statusBox').css('display', 'flex');
  });
  
  $('.trStatus').on('mouseleave', function(e){
    $(this).find('.statusBox').fadeOut();
  });
  $('#dataTable').dataTable( {
    order: [[ 0, 'desc' ], [ 1, 'desc' ]],
    select: true
  } );
  $('#summernote').summernote({
    
    tabsize: 2,
    
    height: 253
    
  });
  setTimeout(function()
  {
    $(".alert").fadeOut();
  }, 2000)
  
  
  $('#sprints').dataTable( {
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
  } );
  
  
  
  $("#avatar").on("change", function()
  {
    $(".PictureContainer i").attr('class', 'fas fa-check');
    $(".PictureContainer .gradient").css('opacity', '1');
  });
  
});

function updateChecklist(id, status, name)
{
  var erro = false;
  var token = $('.updateForm input[name="_token"]').val();

  $.ajax({
    url: '/checklist_update/'+id+'/'+status+'/'+name, // caminho para o script que vai processar os dados
    type: 'put',
    data: {
      "id": id,
      "_token": token,
      "status": status,
      "name": name,
  },
    beforeSend: function () {
        // $(".CreateNew button").text("Adicionando");         
    },   
    success: function(response) {
        if(response.match(/Existem campos em branco./)){
            erro = true;
          }

        if(erro == true)
        {
          
        }
        else
        {

          ui.draggable.remove();

        }
    },
    error: function(xhr, status, error) {
        alert(xhr.responseText);
    }
});

return false;

}

