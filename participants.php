<?php
require_once 'connection.php';
require_once 'classes/Participant.php';

$participantObj = new Participant($conn);
$participants = $participantObj->getAllParticipants();
$total = count($participants);

$menu = [
    ['bi-grid-1x2','Dashboard'],
    ['bi-calendar-event','Events'],
    ['bi-person-badge','Organizers'],
    ['bi-people-fill','Participants','active'],
    ['bi-card-checklist','Registrations']
];

$system = [['bi-gear','Settings'], ['bi-box-arrow-right','Logout']];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>StackEvent | Participants</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}html{scroll-behavior:smooth}
body{margin:0;min-height:100vh;overflow-x:hidden;font-family:Inter,sans-serif;font-size:14px;color:#f2e6e6;background:radial-gradient(circle at 20% 90%,rgba(255,0,40,.18),transparent 35%),radial-gradient(circle at 90% 10%,rgba(255,20,50,.14),transparent 35%),radial-gradient(circle at 50% 50%,rgba(100,0,15,.4),transparent 70%),#140b0d}
.ocean{position:fixed;inset:0;overflow:hidden;pointer-events:none;z-index:-1}
.ocean:before{content:"";position:absolute;width:800px;height:800px;left:-250px;bottom:-300px;border-radius:50%;background:rgba(255,0,40,.12);filter:blur(130px)}
.jelly{position:absolute;width:70px;height:90px;opacity:.3;filter:drop-shadow(0 0 16px rgba(255,40,60,.7));animation:jellyFloat 9s ease-in-out infinite}
.jelly-head{position:absolute;top:0;left:7px;width:56px;height:40px;border-radius:50px 50px 25px 25px;background:radial-gradient(circle at 50% 35%,rgba(255,80,90,.75),rgba(160,0,20,.35));border:1px solid rgba(255,60,70,.7);box-shadow:0 0 25px rgba(255,0,0,.4)}
.jelly-tentacles{position:absolute;top:34px;left:10px;width:55px;height:55px}
.jelly-tentacles span{position:absolute;top:0;width:2px;height:52px;border-radius:10px;background:linear-gradient(transparent,rgba(255,30,50,.9),transparent);animation:tentacle 2.5s ease-in-out infinite}
.jelly-tentacles span:nth-child(1){left:4px}.jelly-tentacles span:nth-child(2){left:15px;height:42px;animation-delay:.3s}.jelly-tentacles span:nth-child(3){left:27px;height:55px;animation-delay:.6s}.jelly-tentacles span:nth-child(4){left:39px;height:43px;animation-delay:.9s}.jelly-tentacles span:nth-child(5){left:50px;height:50px;animation-delay:1.1s}
.jelly.one{left:5%;bottom:-40px;transform:scale(.8)}.jelly.two{left:20%;bottom:-100px;transform:scale(.55);animation-delay:2s}.jelly.three{right:5%;bottom:-80px;transform:scale(1.1);animation-delay:4s}.jelly.four{right:22%;bottom:-120px;transform:scale(.6);animation-delay:6s}
@keyframes jellyFloat{0%{transform:translate(0,0) rotate(-3deg)}50%{transform:translate(35px,-250px) rotate(5deg)}100%{transform:translate(-20px,-520px) rotate(-3deg)}}
@keyframes tentacle{0%,100%{transform:rotate(-4deg)}50%{transform:rotate(5deg)}}
.bubble{position:absolute;bottom:-20px;border:1px solid rgba(255,60,70,.35);border-radius:50%;background:rgba(255,20,30,.08);animation:bubbleUp linear infinite}
.b1{left:12%;width:7px;height:7px;animation-duration:12s}.b2{left:31%;width:4px;height:4px;animation-duration:9s;animation-delay:2s}.b3{right:16%;width:8px;height:8px;animation-duration:14s;animation-delay:4s}.b4{right:34%;width:5px;height:5px;animation-duration:11s;animation-delay:1s}.b5{left:55%;width:3px;height:3px;animation-duration:8s;animation-delay:3s}
@keyframes bubbleUp{0%{transform:translateY(0);opacity:0}15%{opacity:1}100%{transform:translateY(-100vh);opacity:0}}
.sidebar{position:fixed;left:0;top:0;width:220px;height:100vh;padding:20px 14px;background:rgba(28,12,16,.94);border-right:1px solid rgba(255,0,40,.18);backdrop-filter:blur(25px);z-index:100}
.brand{display:flex;align-items:center;gap:10px;padding:0 5px;margin-bottom:32px}
.logo{width:36px;height:36px;display:grid;place-items:center;border-radius:8px;background:linear-gradient(135deg,#ff2233,#880011);box-shadow:0 5px 20px rgba(255,0,0,.5)}
.logo i{font-size:18px;color:#fff}.brand span{font-size:15px;font-weight:800;color:#fff}
.menu-title{color:#b86b72;font-size:11px;font-weight:800;letter-spacing:1px;padding:0 8px;margin:22px 0 10px}
.nav{display:flex;align-items:center;gap:12px;padding:12px;margin:5px 0;border-radius:8px;color:#caa2a7;text-decoration:none;font-size:13px;font-weight:600;transition:.2s}
.nav i{font-size:16px}.nav:hover{color:#fff;background:rgba(255,0,40,.2)}
.nav.active{color:#fff;background:linear-gradient(90deg,rgba(255,0,40,.35),rgba(255,0,40,.08));box-shadow:inset 3px 0 #ff2233}.nav.active i{color:#ff2233}
.main{position:relative;margin-left:220px;width:calc(100% - 220px);padding:25px 35px 55px}
.topbar{height:50px;display:flex;justify-content:space-between;align-items:center;padding-bottom:15px;margin-bottom:28px;border-bottom:1px solid rgba(255,0,40,.15)}
.page-name{font-size:18px;font-weight:800;color:#fff}
.profile{display:flex;align-items:center;gap:12px}
.profile-avatar{width:36px;height:36px;display:grid;place-items:center;border-radius:50%;background:linear-gradient(135deg,#ff2233,#880011);font-size:14px;font-weight:800;color:#fff;box-shadow:0 0 10px rgba(255,0,0,.4)}
.profile-info small{display:block;color:#caa2a7;font-size:11px}.profile-info strong{font-size:13px;color:#fff}
.hero{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:25px}
.label{display:flex;align-items:center;gap:8px;color:#ff3344;font-size:11px;font-weight:800;letter-spacing:1.4px;margin-bottom:8px}
.label:before{content:"";width:8px;height:8px;border-radius:50%;background:#ff2233;box-shadow:0 0 10px #ff2233}
.hero h1{margin:0 0 8px;font-size:42px;font-weight:800;letter-spacing:-.7px;color:#fff}.hero p{margin:0;color:#caa2a7;font-size:15px}
.add-btn{display:flex;align-items:center;gap:8px;padding:12px 18px;border:0;border-radius:8px;color:#fff;background:linear-gradient(135deg,#ff2233,#aa0015);font-size:13px;font-weight:700;box-shadow:0 7px 22px rgba(255,0,0,.4);transition:.2s}
.add-btn:hover{color:#fff;transform:translateY(-2px)}.add-btn i{font-size:14px}
.stats{display:grid;grid-template-columns:1fr 1fr 1.15fr;gap:18px;margin-bottom:22px}
.stat{position:relative;min-height:130px;padding:18px;overflow:hidden;border-radius:12px;background:linear-gradient(135deg,rgba(40,12,18,.9),rgba(20,8,12,.95));border:1px solid rgba(255,0,40,.22);transition:.2s}
.stat:hover{border-color:rgba(255,0,40,.5);transform:translateY(-2px)}
.stat-top{display:flex;justify-content:space-between;align-items:flex-start}
.stat-icon{width:44px;height:44px;display:grid;place-items:center;border-radius:10px;color:#ff3344;background:linear-gradient(135deg,rgba(255,0,40,.25),rgba(120,0,20,.15));border:1px solid rgba(255,0,40,.3)}
.stat-icon i{font-size:20px}
.trend{display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:20px;color:#ff6677;background:rgba(255,0,40,.12);border:1px solid rgba(255,0,40,.25);font-size:11px;font-weight:700}
.trend-label{display:block;margin-top:4px;color:#b86b72;font-size:10px;text-align:right}
.stat-title{margin-top:12px;color:#caa2a7;font-size:11px;font-weight:800;letter-spacing:.6px}
.stat-number{margin-top:4px;font-size:30px;line-height:1;font-weight:800;color:#fff}
.stat-number.active{color:#ff4455;font-size:26px}
.live{display:inline-block;width:8px;height:8px;margin-left:5px;vertical-align:middle;border-radius:50%;background:#ff2233;box-shadow:0 0 10px #ff2233}
.graph{position:absolute;left:75px;right:16px;bottom:14px;height:28px}
.graph svg{width:100%;height:100%}
.graph path{fill:none;stroke:#ff2233;stroke-width:2.5;filter:drop-shadow(0 0 6px rgba(255,0,0,.8))}
.graph circle{fill:#ff2233;filter:drop-shadow(0 0 6px #ff2233)}
.participant-card{overflow:hidden;border-radius:14px;background:linear-gradient(135deg,rgba(32,10,15,.95),rgba(18,6,9,.97));border:1px solid rgba(255,0,40,.22);box-shadow:0 20px 50px rgba(100,0,0,.35)}
.participant-head{display:flex;justify-content:space-between;align-items:center;padding:18px 20px;border-bottom:1px solid rgba(255,0,40,.18)}
.participant-title{display:flex;align-items:center;gap:12px}
.participant-title-icon{width:35px;height:35px;display:grid;place-items:center;border-radius:8px;color:#ff3344;background:rgba(255,0,40,.2)}
.participant-title-icon i{font-size:15px}
.participant-title h5{margin:0;font-size:15px;font-weight:800;color:#fff}
.participant-title small{display:block;color:#b86b72;font-size:11px;margin-top:3px}
.table-tools{display:flex;gap:10px}
.search{position:relative;width:250px}
.search i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#b86b72;font-size:13px}
.search input{width:100%;padding:10px 12px 10px 36px;border-radius:8px;outline:none;color:#fff;background:rgba(255,0,40,.06);border:1px solid rgba(255,0,40,.22);font-size:13px}
.search input:focus{border-color:rgba(255,0,40,.6)}.search input::placeholder{color:#b86b72}
.filter-btn{width:40px;border:1px solid rgba(255,0,40,.3);border-radius:8px;color:#ff3344;background:rgba(255,0,40,.15);font-size:15px}
.table-responsive{overflow-x:auto}
table{width:100%;border-collapse:collapse}
th{padding:14px 18px;color:#b86b72;background:rgba(255,0,40,.06);font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;white-space:nowrap}
td{padding:16px 18px;color:#f2dfdf;font-size:13px;border-top:1px solid rgba(255,0,40,.12);white-space:nowrap}
tbody tr{transition:.18s}tbody tr:hover{background:rgba(255,0,40,.1)}
.participant{display:flex;align-items:center;gap:12px}
.avatar{width:35px;height:35px;display:grid;place-items:center;border-radius:50%;color:#fff;background:linear-gradient(135deg,#ff2233,#66000d);font-size:12px;font-weight:800;box-shadow:0 0 8px rgba(255,0,0,.4)}
.name{color:#fff;font-size:13px;font-weight:600}.email{color:#caa2a7}.id{color:#caa2a7;font-family:monospace}
.gender{display:inline-block;padding:5px 10px;border-radius:6px;font-size:10px;font-weight:800;text-transform:uppercase}
.male{color:#ff88aa;background:rgba(255,0,80,.15);border:1px solid rgba(255,0,80,.3)}
.female{color:#ff66bb;background:rgba(255,0,140,.15);border:1px solid rgba(255,0,140,.3)}
.action{width:32px;height:32px;display:inline-grid;place-items:center;border-radius:8px;color:#caa2a7;background:rgba(255,0,40,.08);border:1px solid rgba(255,0,40,.22);transition:.2s}
.action i{font-size:13px}.action:hover{color:#fff;background:rgba(255,0,40,.3);border-color:rgba(255,0,40,.6)}
.action.delete:hover{color:#ff4444}
.table-footer{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;border-top:1px solid rgba(255,0,40,.18);color:#b86b72;font-size:12px}
.pagination{display:flex;align-items:center;gap:6px}
.page-btn{width:32px;height:32px;display:grid;place-items:center;border-radius:6px;color:#b86b72;background:transparent;border:1px solid transparent;font-size:12px}
.page-btn.active{color:#fff;background:#ff2233;border-color:#ff4455;box-shadow:0 0 10px rgba(255,0,0,.5)}
.page-btn:hover{color:#fff;background:rgba(255,0,40,.2)}
.modal-content{color:#fff;background:#220c12;border:1px solid rgba(255,0,40,.3);border-radius:12px;box-shadow:0 10px 40px rgba(255,0,0,.25)}
.modal-header,.modal-footer{border-color:rgba(255,0,40,.2)}.modal-body{color:#d8b2b8}
.btn-close{filter:invert(1) drop-shadow(0 0 5px red)}
.modal-footer .btn-secondary{background:rgba(255,0,40,.12);border:1px solid rgba(255,0,40,.3);color:#caa2a7;transition:.2s}
.modal-footer .btn-secondary:hover{background:rgba(255,0,40,.25);border-color:rgba(255,0,40,.5);color:#fff}
.modal-footer .btn-primary,.modal-footer .btn-danger{background:linear-gradient(135deg,#ff2233,#aa0015);border:none;box-shadow:0 4px 15px rgba(255,0,0,.4);color:#fff;transition:.2s}
.modal-footer .btn-primary:hover,.modal-footer .btn-danger:hover{background:linear-gradient(135deg,#e01b2a,#880011);transform:translateY(-1px)}
@media(max-width:900px){.sidebar{width:80px}.brand span,.menu-title,.nav span{display:none}.brand,.nav{justify-content:center}.main{margin-left:80px;width:calc(100% - 80px);padding:20px}.stats{grid-template-columns:1fr}.stat{min-height:120px}}
@media(max-width:600px){.hero{align-items:flex-start;flex-direction:column;gap:15px}.participant-head{align-items:flex-start;flex-direction:column;gap:12px}.table-tools{width:100%}.search{width:100%}.table-footer{flex-direction:column;gap:12px;align-items:flex-start}}
</style>
</head>
<body>

<div class="ocean">
    <?php foreach(['one','two','three','four'] as $j): ?>
        <div class="jelly <?= $j ?>"><div class="jelly-head"></div><div class="jelly-tentacles"><?= str_repeat('<span></span>',5) ?></div></div>
    <?php endforeach; ?>
    <?php foreach(['b1','b2','b3','b4','b5'] as $b): ?>
        <div class="bubble <?= $b ?>"></div>
    <?php endforeach; ?>
</div>

<aside class="sidebar">
    <div class="brand"><div class="logo"><i class="bi bi-lightning-charge-fill"></i></div><span>StackEvent</span></div>
    <div class="menu-title">MAIN MENU</div>
    <?php foreach($menu as $item): ?>
        <a href="#" class="nav <?= $item[2] ?? '' ?>"><i class="bi <?= $item[0] ?>"></i><span><?= $item[1] ?></span></a>
    <?php endforeach; ?>
    <div class="menu-title">SYSTEM</div>
    <?php foreach($system as $item): ?>
        <a href="#" class="nav"><i class="bi <?= $item[0] ?>"></i><span><?= $item[1] ?></span></a>
    <?php endforeach; ?>
</aside>

<main class="main">
    <div class="topbar">
        <div class="page-name">Participant Management</div>
        <div class="profile"><div class="profile-avatar">A</div><div class="profile-info"><small>Administrator</small><strong>Analie</strong></div></div>
    </div>

    <section class="hero">
        <div>
            <div class="label">REGISTRATION DESK</div>
            <h1>Participants</h1>
            <p>Manage and monitor all registered event participants.</p>
        </div>
        <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addParticipant"><i class="bi bi-plus-lg"></i> Add Participant</button>
    </section>

    <section class="stats">
        <?php foreach([['bi-people-fill','TOTAL PARTICIPANTS',$total,'12%'], ['bi-person-check-fill','REGISTERED',$total,'8%']] as $card): ?>
            <div class="stat">
                <div class="stat-top">
                    <div class="stat-icon"><i class="bi <?= $card[0] ?>"></i></div>
                    <div><div class="trend"><i class="bi bi-arrow-up"></i><?= $card[3] ?></div><span class="trend-label">vs last month</span></div>
                </div>
                <div class="stat-title"><?= $card[1] ?></div>
                <div class="stat-number"><?= $card[2] ?></div>
                <div class="graph">
                    <svg viewBox="0 0 300 40"><path d="M0 30 C25 25 40 10 65 22 S105 34 130 23 S165 8 190 24 S225 29 245 16 S275 24 300 8"/><circle cx="300" cy="8" r="3"/></svg>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="stat">
            <div class="stat-top"><div class="stat-icon"><i class="bi bi-activity"></i></div></div>
            <div class="stat-title">SYSTEM STATUS</div>
            <div class="stat-number active">ACTIVE <span class="live"></span></div>
        </div>
    </section>

    <section class="participant-card">
        <div class="participant-head">
            <div class="participant-title">
                <div class="participant-title-icon"><i class="bi bi-people-fill"></i></div>
                <div><h5>Registered Participants</h5><small><?= $total ?> participants registered</small></div>
            </div>
            <div class="table-tools">
                <div class="search"><i class="bi bi-search"></i><input type="text" id="search" placeholder="Search participant..."></div>
                <button class="filter-btn" type="button" title="Filter"><i class="bi bi-funnel"></i></button>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr><th>ID</th><th>Participant</th><th>Email</th><th>Gender</th><th>Birthdate</th><th>City</th><th>Actions</th></tr>
                </thead>
                <tbody id="participantTable">
                <?php foreach($participants as $p):
                    $name = $p->first_name.' '.$p->last_name;
                    $initials = strtoupper(substr($p->first_name,0,1).substr($p->last_name,0,1));
                    $gender = strtolower($p->gender) === 'male' ? 'male' : 'female';
                ?>
                    <tr>
                        <td><span class="id"><?= htmlspecialchars($p->participant_id) ?></span></td>
                        <td><div class="participant"><div class="avatar"><?= htmlspecialchars($initials) ?></div><div class="name"><?= htmlspecialchars($name) ?></div></div></td>
                        <td><span class="email"><?= htmlspecialchars($p->email) ?></span></td>
                        <td><span class="gender <?= $gender ?>"><?= htmlspecialchars($p->gender) ?></span></td>
                        <td><?= htmlspecialchars($p->birthdate) ?></td>
                        <td><?= htmlspecialchars($p->city) ?></td>
                        <td>
                            <button type="button" class="action" title="Edit"><i class="bi bi-pencil"></i></button>
                            <button type="button" class="action delete" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteParticipant<?= $p->participant_id ?>"><i class="bi bi-trash3"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div>Showing <strong style="color:#fff"><?= $total ?></strong> participants</div>
            <div class="pagination">
                <button class="page-btn"><i class="bi bi-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <?php foreach($participants as $participant): ?>
        <?php include 'modals/deleteParticipant.php'; ?>
    <?php endforeach; ?>
    <?php include 'modals/addParticipant.php'; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
const search = document.getElementById('search'), table = document.getElementById('participantTable');
search.addEventListener('input', () => {
    const value = search.value.toLowerCase().trim();
    table.querySelectorAll('tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>
</body>
</html>