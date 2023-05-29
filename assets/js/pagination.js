jQuery(document).ready(function( $ ) {


    
   var count,max_pages;
   


    async function getData(counter) {

       
       $( "#list-pagination #spinner").addClass("active")
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
        listData(data);
        
        
        $( "#list-pagination #spinner").removeClass("active")
        $( "#list-pagination .content").addClass("active")
        if( max_pages == 1){
            $( "#list-pagination #pagination").removeClass("active")
        }else{
           
            $( "#list-pagination #pagination").addClass("active")
            
        }
       
      } catch (error) {
        console.log(error);
      }
    }
    
   
    var counter = 1;
    

    $("#list-pagination #pagination").click(function(e){
        
       
        counter +=1;
        getData(counter)
        
    })


    function listData(data) {
  
        $("#list-pagination #posts").empty()
        data.posts.map(function (item) {
            $("#list-pagination #posts").append(`<li><a href="${item.permalink}"><h3">${(item.post_title)?item.post_title:"Post ID: "+item.post_id}</h3></a></li>`);
            
      });

       
   
    }
    getData( 1 );
 
});