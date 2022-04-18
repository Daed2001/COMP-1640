
// VOTING
function update_count(type,id) {
    jQuery.ajax({
       url:'/Idea/voting',
       type:'post',
       data:'type='+type+'&id='+id,
       success:function (result) {

          result = jQuery.parseJSON(result);
        
             if(result.voting_status == 'up-green'){
               $("#up-"+id).css("color", "green");
             }else if(result.voting_status == 'up-green-down-black'){
               $("#up-"+id).css("color", "green");
               $("#down-"+id).css("color", "black");
             }else if(result.voting_status == 'up-black'){
               $("#up-"+id).css("color", "black");
             }else if(result.voting_status == 'down-red'){
               $("#down-"+id).css("color", "red");
             }else if(result.voting_status == 'down-red-up-black'){
               $("#down-"+id).css("color", "red");
               $("#up-"+id).css("color", "black");
             }else if(result.voting_status == 'down-black'){
               $("#down-"+id).css("color", "black");
             }
          jQuery('#voting-num-'+id).html(result.totalvote+ ' Voted');
       }
    })
 }


 $(document).on("click", ".anonymouss", function(e) {
  var thisClicked = $(this);
  var anonymouss = thisClicked.closest('.input-group').find('.anonymouss').val();
  if (thisClicked.prop("checked") == true) {
      anonymouss = 1;
      $('.anonymouss').val(anonymouss);
  } else if (thisClicked.prop("checked") == false) {
      anonymouss = 0;
      $('.anonymouss').val(anonymouss);
  }
});


// ADD COMMENT
$(document).on("click", ".add-comment", function(e) {
  e.preventDefault();
  var thisClicked = $(this);
  var cs = thisClicked.data('cs');

  $.ajax({

  })
  var cmt_id = thisClicked.closest('.input-group').find('.ideaid').val();
  var comment_content = thisClicked.closest('.input-group').find('.comment-input').val();
  var anonymouss = thisClicked.closest('.input-group').find('.anonymouss').val();
  var data = {
      'idea_id': cmt_id,
      'comment_content': comment_content,
      'anonymouss': anonymouss,
  }
  $.ajax({
      type: "POST",
      dataType: 'json',
      url: '/Comment/add',
      data: data,
      success: function(response) {
          console.log(response.comment);
          $("#" + cs).prepend(response.comment);
          if(response.status){
             alert(response.status);
          }
          $(".comment-input").val('');
         
      }

  });
});

 

function choosecategory(type) {
  jQuery.ajax({
     url:'/Idea/index',
     type:'POST',
     data:'type='+type,
     success:function () {
        var url = "http://206.189.84.57/idea/index/"+type;
        document.location = url;
     }
  })
}





