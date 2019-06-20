<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<style>
table,h1,button{
margin-left:30%;
}
table,tr,th,td{
  border:none !important;
}
.lisa{
background-color: #088A68;
border: none;
}
td,th{
padding: 5px;
text-align:center;
}
tr:nth-child(even){
background-color: #e6e6e6
}
button {
  color: white;
  padding: 7px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.delete{
  background-color: #BC2424;
  border: none;

}
.edit{
  border: none;
  background-color: #3D75AC;

}
.edit:hover{
  background-color: #699CD0;
}
.delete:hover{
  background-color: #D46565;
}
.lisa:hover{
  background-color: #77B179;
}
tr:hover{
  background-color:#C0C6D8;
}
#head:hover{
  background-color: white;
}
.entry-content table {
  border: 0px;
}
.entry-content table tr{
  border: 0px;
}
.cover {
  width:500px;/*just for preview*/
  height:10000px;/*just for preview*/
  background:blue;/*just for preview*/
}
</style>
</head>
<h1 style="margin-top:10%;">Grupid</h1>
<a  href="http://localhost/test/add-group/"><button class="btn btn-primary lisa">+ Lisa grupp</button></a><br><br>
<table>
  <tr id="head">
    <th>Struktuurüksuse ID</th>
    <th>Nimi</th>
    <th>Üldmeil</th>
    <th>Aktiivne</th>
    <th></th>
  </tr>
 <tr>
    <td>1</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 1</a></td>
    <td>ut.ak@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
  </tr>
  <tr>
    <td>2</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 2</a></td>
    <td>ut.mtat@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
</tr>
<tr>
    <td>3</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 3</a></td>
    <td>ut.ltat@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
</tr>
<tr>
    <td>3</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 3</a></td>
    <td>ut.ltat@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
</tr>
<tr>
    <td>3</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 3</a></td>
    <td>ut.ltat@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
</tr>
<tr>
    <td>3</td>
    <td><a href="http://localhost/test/inimesed/">Grupp 3</a></td>
    <td>ut.ltat@lists.ut.ee</td>
    <td>Jah</td>
<td>
    <button type="button" class="btn btn-primary edit">Muuda</button>
</td>
</tr>
</table>