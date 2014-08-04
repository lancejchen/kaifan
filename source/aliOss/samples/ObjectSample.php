<?php
require_once dirname(__DIR__).'/aliyun.php';

use Aliyun\OSS\OSSClient;

// Sample of create client
function createClient($accessKeyId, $accessKeySecret) {
    return OSSClient::factory(array(
        'AccessKeyId' => $accessKeyId,
        'AccessKeySecret' => $accessKeySecret,
    ));
}

function listObjects(OSSClient $client, $bucket) {
    $result = $client->listObjects(array(
        'Bucket' => $bucket,
    ));
    foreach ($result->getObjectSummarys() as $summary) {
        echo 'Object key: ' . $summary->getKey() . "<br/>";
    }
}

// Sample of put object from string
function putStringObject(OSSClient $client, $bucket, $key, $content) {
    $result = $client->putObject(array(
        'Bucket' => $bucket,
        'Key' => $key,
        'Content' => $content,
    ));
    echo 'Put object etag: ' . $result->getETag();
}

// Sample of put object from resource
function putResourceObject(OSSClient $client, $bucket, $key, $content, $size) {
    $result = $client->putObject(array(
        'Bucket' => $bucket,
        'Key' => $key,
        'Content' => $content,
        'ContentLength' => $size,
    ));
    return $result->getETag();
}

// Sample of get object
function getObject(OSSClient $client, $bucket, $key) {
    $object = $client->getObject(array(
        'Bucket' => $bucket,
        'Key' => $key,
    ));

    echo "Object: " . $object->getKey() . "\n";
    echo (string) $object;
}

// Sample of delete object
function deleteObject(OSSClient $client, $bucket, $key) {
    $client->deleteObject(array(
        'Bucket' => $bucket,
        'Key' => $key,
    ));
}

function handleExceptionUpload($client) {
    try {
        $client->listBuckets();
    } catch (OSSException $ex) {
        echo "OSSException: " . $ex->getErrorCode() . " Message: " . $ex->getMessage();
    } catch (ClientException $ex) {
        echo "ClientExcetpion, Message: " . $ex->getMessage();
    }
}

$keyId = 'Y3kWx70UR3Ol3fGK';

$keySecret = 'cT46QHG7fpI3y5Umksy650BpbNp9I3';

$client = createClient($keyId, $keySecret);

$bucket = 'kaifan';





$ex = explode(",",$_POST['pic']);//分割data-url数据
$filter=explode('/', trim($ex[0],';base64'));//获取文件类型
$s = base64_decode(str_replace($filter[1] , '', $ex[1]));//图片解码
$tmpRand = rand(0,9);
$picname = $tmpRand.date("YmdHis") . rand(100, 999) .'.'.$filter[1];//生成随机文件名


$key =   $tmpRand.'/'.$picname;
//putStringObject($client, $bucket, $key, '123');
//putResourceObject($client,$bucket,$key,$content,$size);
$eTag = putResourceObject($client, $bucket, $key, $s,strlen($s));


//getObject($client, $bucket, $key);

//listObjects($client,$bucket);
//deleteObject($client, $bucket, $key);
/*
$url = $client->generatePresignedUrl(array(
    'Bucket' => $bucket,
    'Key' => $key
));
*/
//$back = ["return content","I am inside", $url];
//echo $url;
$retData = array('id'=>$key,'picId'=>$key);
$retMsg = array('errCode'=>0,"jumpURL"=>null,"locationTime"=>2000,'message'=>'发表成功','showLogin'=>null,'data'=>$retData);
echo json_encode($retMsg);
?>
