
var doc = null;
var config = {
  'truyen.hixx.info' : {
    'form' : '#content table',
    'links' : 'td:nth-child(2) a',
    'name' : '#content tr:nth-child(2) td:nth-child(2) > h3',
    'detail' : '.chi_tiet'
  },
  'truyenyy.com' : {
    'form' : '.mobi-chuyentrang',
    'links' : 'a',
    'name' : '#noidungtruyen > h1',
    'detail' : '#id_noidung_chuong'
  },
  'truyenfull.vn' : {
    'form' : '.chapter-nav .btn-group',
    'links' : 'a',
    'name' : '.col-xs-12:first-child h2 > a',
    'detail' : '.chapter-content'
  },
  'sstruyen.com' : {
    'form' : 'form',
    'links' : 'a',
    'name' : '.detail-content > span > h3',
    'detail' : '#id_noidung_chuong'
  },
  'truyenvl.net' : {
    'form' : '.chapter-nav',
    'links' : '.btn-group a',
    'name' : '.chapter-title > a',
    'detail' : '.chapter-content'
  },
  'tuchangioi.net' : {
    'form' : '.mobi-chuyentrang',
    'links' : 'a:last-child',
    'name' : '#noidungtruyen > h1',
    'detail' : '#id_noidung_chuong'
  }
}

var comicInit = comics[15];

var main_config = config[comicInit['source']];


comicApp.controller("comicController", function($scope, $http, $sce) {
   $scope.comic = {
      title : comicInit['title'],
      autor : comicInit['autor'],
      source : comicInit['source'],
      name : comicInit['name'],
      chapter_id : comicInit['chapter_id'],
      url : comicInit['url'],
      detail : comicInit['detail'],
      next_chapter : null,
      prev_chapter : null,

      getNextChapter : function(){
         if($scope.comic.next_chapter == null){
            alert('cannot find next chapter');
         } else {
            if($scope.comic.next_chapter.indexOf("http") == -1) 
              $scope.comic.next_chapter = $scope.comic.source + $scope.comic.next_chapter
            $scope.comic.url = $scope.comic.next_chapter;
            $scope.comic.getOriginalPost();
         }
      },

      getNextId : function(){
        $scope.comic.chapter_id++;
        return $scope.comic.chapter_id;
      },

      test : function(){
        if ($scope.comic.url == undefined || $scope.comic.url == ''){
         } else {
            var request_url = 'request.php?url=' + $scope.comic.url;
            console.log(request_url);
            $http.get(request_url).success( function(response) {
              console.log(request_url);
              console.log(response);
               var parser = new DOMParser();
               doc = parser.parseFromString(response, 'text/html');
               var forms = jQuery(doc).find(main_config['form']);
               if(forms.length != 0) {
                  var links = jQuery(forms[0]).find(main_config['links']);
                  $scope.comic.prev_chapter = jQuery(links[0]).attr('href');
                  $scope.comic.next_chapter = jQuery(links[links.length-1]).attr('href');
                  $scope.comic.chapter_id = $scope.comic.getNextId();

                 if(comicInit['source'] == 'truyenfull.vn'){
                  $scope.comic.name = jQuery(doc).find(main_config['name']).attr('title');
                 } else {
                  $scope.comic.name = jQuery(doc).find(main_config['name']).html();
                 }
                  

                  if(comicInit['source'] == 'truyen.hixx.info'){
                    jQuery(doc).find('.chi_tiet div:first-child').remove();
                  }

                  if(comicInit['source'] == 'sstruyen.com'){
                     $scope.comic.updateContent();        
                  } else {
                    $scope.comic.detail = jQuery(doc).find(main_config['detail']).html();      
                  }
                 
               }
            });
         }
      },

      getOriginalPost : function(){
         if ($scope.comic.url == undefined || $scope.comic.url == ''){
         } else {
            var request_url = 'request.php?url=' + $scope.comic.url;
            $http.get(request_url).success( function(response) {
               var parser = new DOMParser();
               doc = parser.parseFromString(response, 'text/html');
               var forms = jQuery(doc).find(main_config['form']);
               if(forms.length != 0) {
                  var links = jQuery(forms[0]).find(main_config['links']);
                  $scope.comic.prev_chapter = jQuery(links[0]).attr('href');
                  $scope.comic.next_chapter = jQuery(links[links.length-1]).attr('href');
                  $scope.comic.chapter_id = $scope.comic.getNextId();

                  if(comicInit['source'] == 'truyenfull.vn'){
                    $scope.comic.name = jQuery(doc).find(main_config['name']).attr('title');
                   } else {
                    $scope.comic.name = jQuery(doc).find(main_config['name']).html();
                   }

                  if(comicInit['source'] == 'http://truyen.hixx.info/'){
                    jQuery(doc).find('.chi_tiet div:first-child').remove();
                  }            
                  if(comicInit['source'] == 'sstruyen.com'){
                     $scope.comic.updateContent();        
                  } else {
                    $scope.comic.detail = jQuery(doc).find(main_config['detail']).html();      
                  }
                  $scope.comic.saveConntent();    
               }
            });
         }
      },

      getPostId : function(){
         var params = $scope.comic.url.split('/');
         var file = params[params.length - 1];
         return file.split('.')[0];
      },

      updateContent : function(){
         var request_url = "http://sstruyen.com/doc-truyen/index.php?ajax=ct&id=" + $scope.comic.getPostId();
         $http.get(request_url).success( function(response) {
            $scope.comic.detail = response;
         });
      },

      saveConntent : function(){
          var comic = {
                  title : $scope.comic.title,
                  autor : $scope.comic.autor,
                  source : $scope.comic.source,
                  name : $scope.comic.name,
                  chapter_id : $scope.comic.chapter_id,
                  url : $scope.comic.url,
                  detail : $scope.comic.detail,
            }; 

          var request = $http({
             method: "post",
             url: 'saveFile.php',
             data: {
                'comic' : comic
             },
             headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
         });
         request.success( function(response) {
            // console.log(response);
            setTimeout(function(){
              $scope.comic.getNextChapter();
            }, 10000);
            
         });
      }

   };
});


