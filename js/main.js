
$.extend({
    getUrlVars: function(){
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },
    getUrlVar: function(name){
      return $.getUrlVars()[name];
    }
  });

$(document).ready(function(){
    let curHref;
    if ($.getUrlVar('order') == "asc"){
        console.log(1);
        curHref = "/main/index/?sort=" + $.getUrlVar('sort') + "&order=asc&";
        $("#" + $.getUrlVar('sort'))[0].href = "/main/index/?sort=" + $.getUrlVar('sort') + "&order=desc";
    } else if ($.getUrlVar('order') == "desc") {
        console.log(2);
        curHref = "/main/index/?sort=" + $.getUrlVar('sort') + "&order=desc&"
        $("#" + $.getUrlVar('sort'))[0].href = "/";
    } else {
        curHref = "/main/index/?";
        $("#user_name")[0].href = "/main/index/?sort=user_name&order=asc";
        $("#user_email")[0].href = "/main/index/?sort=user_email&order=asc";
        $("#task_status")[0].href = "/main/index/?sort=task_status&order=asc";
    }
    
    $(".page_number").click(function () { 
        console.log(curHref);
        $(document)[0].location.href = curHref + "page=" + this.innerText;
     })


    $(".stat_check").click(function () {
        console.log(this.checked);
        if (this.checked){
            $.ajax({
                type: "POST",
                url: "/main/check/",
                data: "checked=1&id=" + this.id
              });
        } else {
            $.ajax({
                type: "POST",
                url: "/main/check/",
                data: "checked=0&id=" + this.id
              });
        }
    })

    $(".admin_text").dblclick(function () {
        let input = document.createElement("textarea");
        let id = this.id;
        input.innerText = this.innerText;
        input.autofocus = true;
        let div = this;
        input.onblur = function () { 
            $.ajax({
                type: "POST",
                url: "/main/edit/",
                data: "id=" + id + "&text=" + this.value,
                success: function () { 
                    div.innerText = input.value;
                    input.remove();
                 }
            });
        }
        this.after(input);
        this.innerText = "";
    })
});