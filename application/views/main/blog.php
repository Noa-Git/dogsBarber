</head>
<body>
<main>
        <div class="container open">
    <br>
      
          <canvas id="mycanvas" height="90px" width="400px" border="1px dotted black">display if browser does not support html canvas</canvas>
        
<script type="text/javascript" src="../JS/Blog_js.js"></script>
      <br>
        כאן תוכלו למצוא מאמרים מתחדשים על טיפול נכון בכלביכם
        
        </div>

    <br><br>
                    
                    <div id="accordion">
  <h4><b>?איך לקלח את הכלב לבד</b></h4>
  <div class="container1" id="shawer"> 
      <p class="text-block test"> הרבה פעמים אנו מעוניינים "לחסוך״ בהוצאות ובוחרים לסדר את הכל לבד… 
זה לא תמיד נכון ולא תמיד חכם אבל לכל מי שבאמת מוכן להתחבר לתהליך 
ויש לו זמן פנוי, מוזמן לעבור על המאמר שכתבנו
    <br>
          <a class="btn btn-info buttonp" href="/main/Continued_Blog#shawe1">להמשך קריאה</a>
        
      </p>
    
      
      
 
  </div>
     <h4><b>?הכלב מפחד מטיפול מה עושים</b></h4>                   
   <div class="container1" id="fear"> 
 
      <p class="text-block"> לקוחות רבים פונים אלינו בשאלות שונות ואנו תמיד משתדלים לספק להם את המענה המהיר והמקצועי ביותר, אחת השאלות שחוזרות אצל לקוחות חדשים שלנו הוא: "הפחד של הכלב מהטיפול, ובחירת ספר כלבים.״
    <br>
          <a class="btn btn-info buttonp" href="/main/Continued_Blog#fear1">להמשך קריאה</a>
           
      </p>
       
       
      
        
  </div>
  <h4><b>פרעושים וקרציות- הצרה הגדולה</b></h4>
    <div class="container1" id="flea"> 
    
      <p class="text-block"> ההפרעושים הם חרקים וטפילים. הם טפילים כי הם חיים על חיות וניזונים מהדם שלהם. כל סוג של פרעוש חי על חשבון פונדקאי כלשהו – כלבים וחתולים בעיקר אך גם עופות ובני אדם. הפרעושים הקופצניים משתמשים בגפי הפה הדוקר שלהם כדי לחדור את העור ולמצוץ דם. הם מגרדים, מטרידים וקשה להיפטר מהם 
    <br>
   <a class="btn btn-info buttonp" href="/main/Continued_Blog#flea1">להמשך קריאה</a>
      </p>
        
         
              
  </div>
</div>
                    

    <br>
    
</main>

 <script>
  $( function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().on( "click", function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  } );
  
  window.onload=function(){
   var canvas = document.getElementById("mycanvas");
var ctx = canvas.getContext("2d");
  var img=new Image();  
  img.src="<?php echo base_url('assets/Pictures/banner.jpg'); ?>";
   img.onload=function(){
       ctx.drawImage(img,10,00);
   ctx.font="50px Comic Sans MS";
ctx.fillStyle= "black";
ctx.shadowColor = "grey";
 ctx.shadowOffsetX = 10;
  ctx.shadowOffsetY = 10;
  ctx.shadowBlur = 10;
ctx.textAlign = "center";
ctx.fillText("הבלוג שלנו", canvas.width/1.90, canvas.height/1.5);

   }; 
}
  </script>