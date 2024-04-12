<?php



// get time post ago :
function getTimeAgo($since){
    $timepost=$since; // type($since)=time;
    $timeago=(time()-$timepost);
    if($timeago<60){
      $ago = '  منذ  '.$timeago.' ثانية .';
    }
    elseif($timeago<3600){
      $ago = '  منذ  '.intdiv($timeago,60).' دقيقة .';
    }
    elseif($timeago<7200){
      $ago = ' منذ ساعة ';
    }
    elseif($timeago<86400){
      $ago = ' منذ '.intdiv($timeago,3600).' ساعات ';
    }
    elseif($timeago<172800){
      $ago = 'منذ يوم ';
    }else{
      $ago = '  منذ '.intdiv($timeago,86400).' يوم ';
    }
    return $ago;
}



// get latest manga ids :
function deleteDuplicate($Array){
  $newArray=array();
  array_push($newArray,$Array[1]);
  for($i=2;$i<sizeof($Array);$i++){
    $item=$Array[$i];
    if (!in_array($item,$newArray)){
      array_push($newArray,$item);
    }
  }
 
 return $newArray;
}

function latestMangaIDs(){
  global $con;
  $searchmanga=$con->prepare("SELECT MangaID FROM `manga_chapter` order by ReleaseDate DESC;");
  $searchmanga->execute();
  $popmangas=$searchmanga->fetchAll();


  $MangaIDs=array();
  $i=0;
  foreach($popmangas as $manga){
      $i++;
      $MangaIDs[$i]=$manga["MangaID"];
  }

  return deleteDuplicate($MangaIDs);
}



// get latest update date :
function updateDate($MangaID){
  global $con;
  $searchmanga=$con->prepare("SELECT MAX(ReleaseDate) as dt from manga_chapter where MangaID= ?;");
  $searchmanga->execute(array($MangaID));
  $date=$searchmanga->fetch();

  return $date["dt"];
}

// get next chapter in manga :
function getChapterNbr($ChapterID,$MangaID){
    global $con;

    $sql1="SELECT * FROM `manga_chapter` WHERE MangaID=? ORDER BY ChapterNumber DESC";
    $search1=$con->prepare($sql1);
    $search1->execute(array($MangaID)); 
    $chapters=$search1->fetchAll();

    $sql="SELECT * FROM `manga_chapter` WHERE ChapterID=? ";
    $search=$con->prepare($sql);
    $search->execute(array($ChapterID)); 
    $actChapter=$search->fetch();  //actual chapter

    $ChapterNbr=0;
    $id=-1;
    foreach($chapters as $chapter){
      $id++;
      if($chapter['ChapterID']==$actChapter['ChapterID']){
        $ChapterNbr=$id;
      }
    }

    return $ChapterNbr;
}


// rating star 
function  Rating($rat){
  $div= array();
  switch ($rat) {
    case 0:
      $div[0]="fa-regular fa-star";
      $div[1]="fa-regular fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;

      
    case 0.5:
      $div[0]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[1]="fa-regular fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 1:
      $div[0]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[1]="fa-regular fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 1.5:
      $div[0]="fa fa-star";
      $div[1]="fa-regular fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 2:
      $div[0]="fa fa-star";
      $div[1]="fa-regular fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;



    case 2.5:
      $div[0]="fa fa-star";
      $div[1]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 3:
      $div[0]="fa fa-star";
      $div[1]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 3.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 4:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa-regular fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 4.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 5.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 6:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 6.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa-regular fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 7:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[4]="fa-regular fa-star";
      break;


    case 7.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      $div[4]="fa-regular fa-star";
      break;


    case 8:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 8.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa fa-star";
      $div[4]="fa-regular fa-star";
      break;


    case 9:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa fa-star";
      $div[4]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      break;


    case 9.5:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa fa-star";
      $div[4]="fa-solid fa-star-half-stroke fa-flip-horizontal";
      break;


    case 10:
      $div[0]="fa fa-star";
      $div[1]="fa fa-star";
      $div[2]="fa fa-star";
      $div[3]="fa fa-star";
      $div[4]="fa fa-star";
      break;


    default:
      # code...
      break;
  }
  return $div;
}