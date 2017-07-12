<!DOCTYPE html>
<html>
<head>
	<title>履歷維護</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
	<!-- 	<link rel="stylesheet" href="../../public/css/resume_stu.css"> -->
	<link rel="stylesheet" href="css/resume_stu.css">
</head>
<body>
	<div class="container">
		<div class="sidebar">
			<nav class="menu">
				<ul>
					<li class="item"><a href="#announcement"><img src="../../public/images/icon/noti.png">訊息公告</a></li>
					<li class="item"><a href="#cooperation"><img src="../../public/images/icon/cooperation.png">合作廠商</a></li>
					<li class="item"><a href="#job"><img src="../../public/images/icon/job.png">職缺查詢</a></li>
					<li class="item"><a href="#resume"><img src="../../public/images/icon/resume.png">履歷維護</a></li>
					<li class="item"><a href="#score"><img src="../../public/images/icon/score.png">我的成績</a></li>
					<li class="item"><a href="#report"><img src="../../public/images/icon/report.png">我的週誌</a></li>
					<li class="item"><a href="#download"><img src="../../public/images/icon/download.png">表單下載</a></li>
					<li class="item"><a href="#contact"><img src="../../public/images/icon/about.png">關於我們</a></li>
				</ul>
				<hr/>
				<ul>
					<li class="function"><a href="#top" class="top"><img src="../../public/images/icon/top.png"> BACK TO TOP</a></li>
					<li class="function"><a href=""><img src="../../public/images/icon/logout.png"> LOG OUT</a></li>
				</ul>
			</nav>
		</div>
		<div class="burger">MENU</div>
		<div class="wrapper">
			<div class="header">
				<h2 class="pulse animated">RESUME</h2>
			</div>

			<div class="group group1">
				<h2><img src="../../public/images/icon/person.png">基本資料</h2><hr>
				<table class="table" id='BasicData'>
					<tbody>
						<tr>
							<th>中文姓名 </th>
							<td><input type="text" name="chiName" id='chiName' class='data' required></td>
						</tr>
						<tr>
							<th>英文姓名 </th>
							<td><input type="text" name="engName" id='engName' class='data' required></td>
						</tr>
						<tr>
							<th>出生地 </th>
							<td><input type="text" name="bornPlace" id='bornPlace' class='data' required></td>
						</tr>
						<tr>
							<th>籍貫 </th>
							<td><input type="text" name="nativePlace" id='nativePlace' class='data'></td>
						</tr>
						<tr>
							<th>生日 </th>
							<td><input type="date" name="birthday" id='birthday' class='data'></td>
						</tr>
						<tr>
							<th>性別 </th>
							<td >
								<input type="radio" name="gender" value="0"> 男
								<input type="radio" name="gender" value="1"> 女
								<input type="radio" name="gender" value="2"> 其他
							</td>
						</tr>
						<tr>
							<th>身高 </th>
							<td><input type="text" name="height" id='height' class='data'></td>
						</tr>
						<tr>
							<th>體重 </th>
							<td><input type="text" name="weight" id='weight' class='data'></td>
						</tr>
						<tr>
							<th>血型 </th>
							<td>
								<input type="radio" name="bloodType" value="0"> O
								<input type="radio" name="bloodType" value="1"> A
								<input type="radio" name="bloodType" value="2"> B
								<input type="radio" name="bloodType" value="3"> AB
								<input type="radio" name="bloodType" value="4"> 其他
							</td>
						</tr>
						<tr>
							<th>戶籍地址 </th>
							<td><input type="text" name="address" id='address' class='data'></td>
						</tr>
						<tr>
							<th>電子郵件 </th>
							<td><input type="email" name="email" id='email' class='data'></td>
						</tr>
						<tr>
							<th>聯絡方式 </th>
							<td><input type="tel" name="contact" id='contact' class='data'></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="group group1">
				<h2><img src="../../public/images/icon/language.png">語言能力</h2><hr>
				<table class="table"  id='Language'>
					<tbody>
						<tr>
							<th>中文聽力 </th>
							<td>
								<input type="radio" name="cl" value="0"> 不懂
								<input type="radio" name="cl" value="1"> 略懂
								<input type="radio" name="cl" value="2"> 可流暢使用
								<input type="radio" name="cl" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>中文口說 </th>
							<td>
								<input type="radio" name="cs" value="0"> 不懂
								<input type="radio" name="cs" value="1"> 略懂
								<input type="radio" name="cs" value="2"> 可流暢使用
								<input type="radio" name="cs" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>中文閱讀 </th>
							<td>
								<input type="radio" name="cr" value="0"> 不懂
								<input type="radio" name="cr" value="1"> 略懂
								<input type="radio" name="cr" value="2"> 可流暢使用
								<input type="radio" name="cr" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>中文書寫 </th>
							<td>
								<input type="radio" name="cw" value="0"> 不懂
								<input type="radio" name="cw" value="1"> 略懂
								<input type="radio" name="cw" value="2"> 可流暢使用
								<input type="radio" name="cw" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>英文聽力 </th>
							<td>
								<input type="radio" name="el" value="0"> 不懂
								<input type="radio" name="el" value="1"> 略懂
								<input type="radio" name="el" value="2"> 可流暢使用
								<input type="radio" name="el" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>英文口說 </th>
							<td>
								<input type="radio" name="es" value="0"> 不懂
								<input type="radio" name="es" value="1"> 略懂
								<input type="radio" name="es" value="2"> 可流暢使用
								<input type="radio" name="es" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>英文閱讀 </th>
							<td>
								<input type="radio" name="er" value="0"> 不懂
								<input type="radio" name="er" value="1"> 略懂
								<input type="radio" name="er" value="2"> 可流暢使用
								<input type="radio" name="er" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>英文書寫 </th>
							<td>
								<input type="radio" name="ew" value="0"> 不懂
								<input type="radio" name="ew" value="1"> 略懂
								<input type="radio" name="ew" value="2"> 可流暢使用
								<input type="radio" name="ew" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>臺語聽力 </th>
							<td>
								<input type="radio" name="tl" value="0"> 不懂
								<input type="radio" name="cl" value="1"> 略懂
								<input type="radio" name="cl" value="2"> 可流暢使用
								<input type="radio" name="cl" value="3"> 精通
							</td>
						</tr>
						<tr>
							<th>臺語口說 </th>
							<td>
								<input type="radio" name="ts" value="0"> 不懂
								<input type="radio" name="ts" value="1"> 略懂
								<input type="radio" name="ts" value="2"> 可流暢使用
								<input type="radio" name="ts" value="3"> 精通
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/computer.png">電腦技術能力 <i class="fa fa-plus AddAbi"  aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table class="table" id='Ability'>
					<tbody>
						<tr>
							<td >
								<select name="" class=''>
									<option value="0">資料庫</option>
									<option value="1">程式語言</option>
									<option value="2">網頁設計</option>
									<option value="3">文書處理</option>
									<option value="4">影像剪輯</option>
									<option value="5">繪圖軟體</option>
									<option value="6">動畫製作</option>
									<option value="7">作業系統</option>
									<option value="8">音效剪輯</option>
								</select>
							</td>
							<td><input type="text" name=""></td>
						</tr>
						<tr class="AbiInput"></tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/grade.png">學歷 <i class="fa fa-plus AddEdu"  aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table id='EduData'>
					<tbody>
						<tr>
							<th>學校名稱 </th>
							<th>科系名稱 </th>
							<th>學位 </th>
							<th>入學日期 </th>
							<th>離校日期 </th>
							<th>就讀狀態 </th>
						</tr>
						<tr>
							<td><input type="text" name="school" class='school'></td>
							<td><input type="text" name="department" class='department'></td>
							<td><input type="text" name="department" class='degree'></td>
							<td><input type="date" name="enterDate" class='enterDate'></td>
							<td><input type="date" name="exitDate" calss='exitDate'></td>
							<td>
								<select name="graduate" class='graduate'>
									<option value="0"> 畢業</option>
									<option value="1"> 肄業</option>
									<option value="2"> 在學中</option>
								</select>
							</td>
						</tr>
						<tr class="EduInput"></tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/work.png">工作經歷 <i class="fa fa-plus AddJob" aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table id='JobExperience'>
					<tbody>
						<tr>
							<th>工作名稱 </th>

							<th>公司名稱 </th>
						</tr>
						<tr>
							<td><input type="text" name="semester" class='semester'></td>
							<td><input type="text" name="jobTitle" class='jobTitle'></td>
						</tr>
						<tr class="JobInput"></tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/license.png">相關證照 <i class="fa fa-plus AddLic" aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table id='License'>
					<tbody>
						<tr>
							<th>發證單位 </th>
							<th>證照名稱 </th>
							<th>發證日期 </th>
						</tr>
						<tr >
							<td><input type="text" name="agency" class='agency'></td>
							<td><input type="text" name="lname" class='lname'></td>
							<td><input type="date" name="ldate" class='ldate'></td>
						</tr>
						<tr class="LicInput"></tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/outcome.png">專題及作品 <i class="fa fa-plus AddWork" aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table >
					<tbody id='WorksData'>
						<tr>
						</tr>
						<tr>
							<th>作品名稱 </th>
							<th>作品年份 </th>
							<th>作品備註 </th>
						</tr>
						<tr >
							<td><input type="text" name="wName" class='wName'></td>
							<td><input type="text" name="wCreatedDate" class='wCreatedDate'></td>
							<td><input type="text" name="wLink" class='wLink'></td>
						</tr>
						<tr class="WorkInput"></tr>
					</tbody>
				</table>
			</div>
			<div class="group group2">
				<h2><img src="../../public/images/icon/family.png">親屬關係 <i class="fa fa-plus AddRel" aria-hidden="true" title="點此新增下一筆"></i></h2><hr>
				<table id='RelativeData'>
					<tbody>
						<tr>
						</tr>
						<tr>
							<th>關係 </th>
							<th>姓名 </th>
							<th>年齡 </th>
							<th>教育程度 </th>
							<th>職業 </th>
						</tr>
						<tr >
							<td><input type="text" name="rType" class='rType'></td>
							<td><input type="text" name="rName" class='rName'></td>
							<td><input type="text" name="rAge" class='rAge'></td>
							<td>
								<select name="rEdu" class='rEdu'>
									<option value="0">國小</option>
									<option value="1">國中</option>
									<option value="2">高中</option>
									<option value="3">大專院校</option>
									<option value="4">學士</option>
									<option value="5">碩士</option>
									<option value="6">博士</option>
									<option value="7">其他</option>
								</select>
							</td>
							<td><input type="text" name="rJob" class='rJob' required></td>
						</tr>
						<tr class="RelInput"></tr>
					</tbody>
				</table>
			</div>

			<div style="text-align:center;"><button type="submit" id="Edit">確認修改</button></div>
			<div class="footer">
				Copyright &copy; 2017
			</div>
		</div>
	</div>
	<script src="https://use.fontawesome.com/47c3283935.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script>
	<script src="../../public/js/valid.js"></script>
	<script src="js/valid.js"></script>
</body>
</html>