//app.js

 const edit_endereco = document.getElementById("edit_endereco");
 const btn_close_modal = document.querySelector(".btn-close");

 if(btn_close_modal ) {

      btn_close_modal.addEventListener("click", ()=> {
            $(".modal").hide();
      });
 }

 
     function adiciona_carrinho(id_produto){
                 //let data = {id : id_item, action : 'add'};
                 const bagde = document.querySelector(".badge");
                 
                 let xhr = new XMLHttpRequest();
                   xhr.open("GET","?a=adiciona_carrinho&id="+parseInt(id_produto), true);
                   xhr.onreadystatechange = function() {
 
                     if(xhr.readyState == 4) {
                      
                        if(xhr.status == 200) {
                         let data = JSON.parse(xhr.responseText);
                         if(data.status == 'Ok'){
                           $(".modal").show();
                         }
                         document.getElementById("total_carrinho").textContent = data.total_carrinho;
                       }
                      
                     }
                   }
                    xhr.send();
      }
        
    function remove_item(id) {

       let btn_click = id.getAttribute("data-id");
      
       let xhr = new XMLHttpRequest();

           xhr.open("GET","?a=remove_item&_id="+ btn_click);

           xhr.onreadystatechange = function(){

            if(xhr.readyState == 4) {
              if(xhr.status == "200"){

                let data = JSON.parse(xhr.responseText);
                   if(data.status == "Ok"){
                           document.location = data.url;
                   }else {
                      alert("Não possível remover item do carrinho !");
                   }
               }
            }
            
           }
           xhr.send();
    }

    function limpar_carrinho() {

         let confirm = document.querySelector(".confirm");
         if(confirm.style.display == "none") {
            confirm.style.display = "inline";
         }else {
          confirm.style.display = "none"
         }
    }

    function toggleNavBar(evt){
       
        let colapsed = document.getElementById("navbarSupportedContent");

        if(colapsed.classList.contains("collapse")){
            colapsed.classList.remove("collapse");
            evt.innerHTML = `x fechar`;
        } else {
           colapsed.classList.add("collapse");
           evt.innerHTML = ` <span class="navbar-toggler-icon"></span>`;
        }
        
    }
