<html lang="en">
<head>
    <meta name="author" content="MohamedDine">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For You </title>
</head>
<style>
    * {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    padding: 0;
    margin: 0;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
    font-family: 'Arial', sans-serif;
}

.card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 90%;
    position: relative;
    overflow: hidden;
}

.heart-container {
    margin: 2rem 0;
    position: relative;
}

.heart {
    fill: #ff4b6e;
    transform-origin: center;
    animation: pulse 1.5s ease-in-out infinite;
}

.message {
    font-size: 1.5rem;
    color: #333;
    margin: 1rem 0;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 1s ease-out forwards;
}

.btn-container {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin: 1rem 0;
}

.btn {
    background: #ff4b6e;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: transform 0.3s, background 0.3s;
}

.btn:hover {
    background: #ff3356;
    transform: scale(1.05);
}

.btn.no {
    background: #666;
}

.btn.no:hover {
    background: #555;
}

.floating-hearts {
    position: absolute;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.question {
    display: none;
}

.question.active {
    display: block;
}

.no-btn-container {
    position: relative;
}

.no-btn-container .btn.no {
    position: relative;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0% { transform: translateY(0) rotate(0deg); }
    100% { transform: translateY(-100vh) rotate(360deg); }
}

@keyframes dodge {
    0% { transform: translateX(0); }
    50% { transform: translateX(100px); }
    100% { transform: translateX(0); }
}

.sparkle {
    fill: #ffd700;
    animation: sparkle 1s ease-in-out infinite;
}

@keyframes sparkle {
    0% { opacity: 0; }
    50% { opacity: 1; }
    100% { opacity: 0; }
}

.broken-heart {
    display: none;
    fill: #666;
}
</style>
<body>
    <div class="card">
        <div class="heart-container">
            <svg viewBox="0 0 100 100" width="100" height="100">
                <path class="heart" d="M50 88.9L16.7 55.6C7.2 46.1 7.2 30.9 16.7 21.4s24.7-9.5 34.2 0L50 20.5l-0.9 0.9c9.5-9.5 24.7-9.5 34.2 0s9.5 24.7 0 34.2L50 88.9z"/>
                <path class="broken-heart" d="M50 88.9L16.7 55.6C7.2 46.1 7.2 30.9 16.7 21.4s24.7-9.5 34.2 0L50 20.5l-0.9 0.9c9.5-9.5 24.7-9.5 34.2 0s9.5 24.7 0 34.2L50 88.9z"/>
                <circle class="sparkle" cx="25" cy="25" r="2"/>
                <circle class="sparkle" cx="75" cy="25" r="2"/>
                <circle class="sparkle" cx="50" cy="15" r="2"/>
            </svg>
        </div>

        <div class="question active" id="q1">
            <h1 class="message">คุณใช่คนที่น่ารัก ขี้ดื้อใช่ไหม? 💝</h1>
            <div class="btn-container">
                <button class="btn" onclick="nextQuestion(true, 1)">Yes!</button>
                <div class="no-btn-container">
                    <button class="btn no" onclick="handleNo()" onmouseover="dodgeNo()">No</button>
                </div>
            </div>
        </div>

        <div class="question" id="q2">
            <h1 class="message">คุณจะเป็นความสดใสของผมได้หรือเปล่า? 🌹</h1>
            <div class="btn-container">
                <button class="btn" onclick="nextQuestion(true, 2)">ได้ค่ะ</button>
                <div class="no-btn-container">
                    <button class="btn no" onclick="handleNo()" onmouseover="dodgeNo()">ไม่อ่า ไม่ได้</button>
                </div>
            </div>
        </div>

        <div class="question" id="q3">
            <h1 class="message">คุณชอบผมไหม? 🤗</h1>
            <div class="btn-container">
                <button class="btn" onclick="nextQuestion(true, 3)">Yes!</button>
                <div class="no-btn-container">
                    <button class="btn no" onclick="handleNo()" onmouseover="dodgeNo()">No</button>
                </div>
            </div>
        </div>

        <div class="question" id="final">
            <h1 class="message">พี่เป็นความสุขของผมนะ 555+! ❤️</h1>
        </div>
        <div class="question" id="rejected">
            <h1 class="message">😢 เสียใจ แต่ขอถามอีกรอบได้ไหม?</h1>
            <div class="btn-container">
                <button class="btn" onclick="resetQuestions()">Ok, let me try again</button>
            </div>
        </div>
        <div class="floating-hearts"></div>
    </div>

    <script>
        let noButtonDodgeCount = 0;
const maxDodges = 5;

function nextQuestion(accepted, questionNumber) {
    if (accepted) {
        document.querySelector(`#q${questionNumber}`).classList.remove('active');
        if (questionNumber < 3) {
            document.querySelector(`#q${questionNumber + 1}`).classList.add('active');
        } else {
            document.querySelector('#final').classList.add('active');
            celebrateAcceptance();
        }
    }
}

function handleNo() {
    if (noButtonDodgeCount >= maxDodges) {
        document.querySelectorAll('.question').forEach(q => q.classList.remove('active'));
        document.querySelector('#rejected').classList.add('active');
        document.querySelector('.heart').style.display = 'none';
        document.querySelector('.broken-heart').style.display = 'block';
    }
}

function dodgeNo() {
    if (noButtonDodgeCount < maxDodges) {
        const btn = document.querySelector('.btn.no');
        btn.style.transform = `translate(${Math.random() * 200 - 100}px, ${Math.random() * 100 - 50}px)`;
        noButtonDodgeCount++;
    }
}

function resetQuestions() {
    document.querySelectorAll('.question').forEach(q => q.classList.remove('active'));
    document.querySelector('#q1').classList.add('active');
    document.querySelector('.heart').style.display = 'block';
    document.querySelector('.broken-heart').style.display = 'none';
    noButtonDodgeCount = 0;
    const noBtn = document.querySelector('.btn.no');
    noBtn.style.transform = 'none';
}

function celebrateAcceptance() {
    const container = document.querySelector('.floating-hearts');
    for (let i = 0; i < 15; i++) {
        createHeart(container);
    }
}

function createHeart(container) {
    const heart = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    heart.setAttribute('viewBox', '0 0 100 100');
    heart.style.width = '30px';
    heart.style.height = '30px';
    heart.style.position = 'absolute';
    heart.style.left = Math.random() * 100 + '%';
    heart.style.animation = `float ${3 + Math.random() * 3}s linear infinite`;
    
    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path.setAttribute('d', 'M50 88.9L16.7 55.6C7.2 46.1 7.2 30.9 16.7 21.4s24.7-9.5 34.2 0L50 20.5l-0.9 0.9c9.5-9.5 24.7-9.5 34.2 0s9.5 24.7 0 34.2L50 88.9z');
    path.style.fill = `hsl(${Math.random() * 60 + 330}, 100%, 65%)`;
    
    heart.appendChild(path);
    container.appendChild(heart);
    
    setTimeout(() => {
        container.removeChild(heart);
    }, 6000);
}
    </script>
</body>
</html>
