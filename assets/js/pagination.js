jQuery(document).ready(function( $ ) {


    
   var count,max_pages;
   


    async function getData(counter) {

       
       $( "#spinner").addClass("active")
      try {
   
        let quantity = counter * ajax_var.per_page;
        
        const url = ajax_var.url+`/?page=${counter}&per_page=${quantity}`
        
        const headers = new Headers({
            'Content-Type': 'application/json',
            'X-WP-Nonce': ajax_var.nonce
        });
        let params = {
            method: 'get',
            headers: headers,
           
        }
        const response = await fetch(url,params);
        const data = await response.json();
        
        count = data.count;
        max_pages = data.max_pages;
        console.log(max_pages)
        listData(data);
        
        
        $( "#spinner").removeClass("active")
        $( ".content").addClass("active")
        if( max_pages == 1){
           console.log("Holas")
            $( "#pagination").removeClass("active")
        }else{
           
            $( "#pagination").addClass("active")
            
        }
       
      } catch (error) {
        console.log(error);
      }
    }
    
   
    var counter = 1;
    

    $("#pagination").click(function(e){
        
       
        counter +=1;
        getData(counter)
        
    })


    function listData(data) {
  
        $("#posts").empty()
        data.posts.map(function (item) {
            $("#posts").append(`<li><a href="${item.permalink}"><h3">${(item.post_title)?item.post_title:"Post ID: "+item.post_id}</h3></a></li>`);
            
      });

       
   
    }
    getData( 1 );
 
});