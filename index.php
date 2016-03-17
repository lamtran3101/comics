<!DOCTYPE html>
<html lang="en-US">
   <head>
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
      <script src = "./mainApp.js"></script>
      <script src = "./comics.js"></script>
      <script src = "./comicController.js"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   </head>
   <body>
      
    <h1>Comic project</h1>
    <div ng-app = "ComicApp" ng-controller = "comicController">
      <div id="panels">
         <div class="panel">
            <input type="text" ng-model = "comic.title">
            <input type="text" ng-model = "comic.autor">
            <input type="text" ng-model = "comic.source">
            <input type="text" ng-model = "comic.url">
            <button ng-click = "comic.getOriginalPost()">Get Comic</button>
             <button ng-click = "comic.saveConntent()">Save Comic</button>
             <button ng-click = "comic.getNextChapter()">Next chapter</button>
             <button ng-click = "comic.test()">Test</button>
         </div>
      </div>

      <div id="result">
         <div class="field">
            <label>Title</label>
            {{ comic.title}}
         </div>
         <div class="field">
            <label>Autor</label>
            {{ comic.autor}}
         </div>
         <div class="field">
            <label>Source</label>
            {{ comic.source}}
         </div>
         <div class="field">
            <label>Url</label>
            {{ comic.url}}
         </div>
          <div class="field">
            <label>Post id</label>
            {{ comic.getPostId()}}
         </div>
         <div class="field">
            <label>Chapter name</label>
            {{ comic.name}}
         </div>
         <div class="field">
            <label>Chapter id</label>
            {{ comic.chapter_id}}
         </div>
         <div class="field">
            <label>Next</label>
            {{ comic.next_chapter}}
         </div>
         <div class="field">
            <label>Prev</label>
            {{ comic.prev_chapter}}
         </div>
         <div class="field">
            <label>Detail</label>
            <div id="chapter-content">
               {{ comic.detail}}
            </div>
                
         </div>
      </div>
      
   </div>
      
   </body>
</html>