<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Be My Valentine 💖</title>
    @vite('resources/css/app.css')

    <style>
        body { cursor: pointer; overflow: hidden; }

        /* Floating hearts background */
        .heart {
            position: fixed;
            bottom: -20px;
            font-size: 20px;
            animation: floatUp linear forwards;
            opacity: 0.8;
            pointer-events: none;
        }

        @keyframes floatUp {
            from { transform: translateY(0) scale(1); opacity: 0.8; }
            to { transform: translateY(-120vh) scale(1.6); opacity: 0; }
        }

        /* Firework particles */
        .particle {
            position: fixed;
            font-size: 25px;
            pointer-events: none;
            animation: explode 1s ease-out forwards;
        }

        @keyframes explode {
            from { transform: translate(0,0) scale(1); opacity: 1; }
            to { transform: translate(var(--x), var(--y)) scale(1.5); opacity: 0; }
        }

        /* Overlay for YES screen */
        #successMessage {
            background-color: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        /* YES MESSAGE BOX */
        #messageBox {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 2rem;
            text-align: center;
            color: #e91e63;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 0 50px rgba(255,0,100,0.5);
        }
    </style>
</head>

<body class="bg-pink-100 flex items-center justify-center min-h-screen relative">

<audio id="bgMusic" loop>
    <source src="{{ asset('music/d14u.mp3') }}" type="audio/mpeg">
</audio>

<div class="bg-white shadow-2xl rounded-3xl p-10 text-center relative w-96 z-10">

    <h1 class="text-3xl font-bold text-pink-600 mb-6 animate-pulse">
        Will You Be My Valentine, Emerald Kaye? 💕
    </h1>

    <!-- TYPEWRITER BOLD -->
    <p id="typewriter" class="font-bold text-gray-800 mb-10 min-h-[60px]"></p>

    <!-- YES BUTTON -->
    <button
        onclick="sayYes(event)"
        id="yesBtn"
        class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-full text-lg font-semibold transition"
    >
        YES 💖
    </button>

</div>

<!-- NO BUTTON -->
<button
    id="noBtn"
    class="bg-gray-400 text-white px-8 py-3 rounded-full text-lg font-semibold fixed"
    style="top: 80%; left: 50%; transform: translate(-50%, -50%);"
>
    NO 🥲
</button>

<!-- SUCCESS MESSAGE OVERLAY -->
<div id="successMessage"
     class="fixed inset-0 flex items-center justify-center hidden"
     style="display: none;"> <!-- force hidden initially -->
    <div id="messageBox">
        HALAAA YESS KUNO!!💘🎆 PERO JOKE LANG, KASAB AN TAS ATE ISSHI NIMO.
    </div>
</div>
<script>
    /* 💕 FLOATING HEARTS BACKGROUND */
    function createHeart() {
        const heart = document.createElement("div");
        heart.classList.add("heart");
        heart.innerHTML = "💖";
        heart.style.left = Math.random() * 100 + "vw";
        heart.style.animationDuration = (Math.random() * 3 + 3) + "s";
        document.body.appendChild(heart);
        setTimeout(() => heart.remove(), 6000);
    }
    setInterval(createHeart, 400);

    /* ⌨️ BOLD TYPEWRITER */
    const message = "It hasn’t been long, but meeting you already feels like something worth remembering.";
    let index = 0;
    function typeWriter() {
        if (index < message.length) {
            document.getElementById("typewriter").innerHTML += message.charAt(index);
            index++;
            setTimeout(typeWriter, 40);
        }
    }
    window.onload = typeWriter;

    /* 🏃 NO BUTTON RUNS AROUND SCREEN */
    const noBtn = document.getElementById("noBtn");
    document.addEventListener("mousemove", function(e) {
        const rect = noBtn.getBoundingClientRect();
        const distance = Math.hypot(
            e.clientX - (rect.left + rect.width/2),
            e.clientY - (rect.top + rect.height/2)
        );
        if (distance < 120) {
            const maxX = window.innerWidth - rect.width;
            const maxY = window.innerHeight - rect.height;
            const randomX = Math.random() * maxX;
            const randomY = Math.random() * maxY;
            noBtn.style.left = randomX + "px";
            noBtn.style.top = randomY + "px";
        }
    });

    /* 💖 YES EXPLOSION WITH CONTINUOUS HEARTS AND MUSIC */
    function sayYes(e) {
        const overlay = document.getElementById("successMessage");
        overlay.style.display = "flex";
        overlay.classList.remove("hidden");

        // 🎵 Play music on YES
        const music = document.getElementById('bgMusic');
        music.play().catch(() => console.log("Music playback failed"));

        // continuous heart/firework explosions
        const interval = setInterval(() => {
            const particle = document.createElement("div");
            particle.classList.add("particle");
            particle.innerHTML = ["💖","💘","💝","✨","🎆"][Math.floor(Math.random()*5)];

            particle.style.left = Math.random() * window.innerWidth + "px";
            particle.style.top = Math.random() * window.innerHeight + "px";

            const angle = Math.random() * 2 * Math.PI;
            const distance = Math.random() * 300;

            particle.style.setProperty('--x', Math.cos(angle) * distance + "px");
            particle.style.setProperty('--y', Math.sin(angle) * distance + "px");

            document.body.appendChild(particle);
            setTimeout(() => particle.remove(), 1500);
        }, 100);

        setTimeout(() => clearInterval(interval), 5000);
    }

</script>
<script>
    // wait for user interaction to start music
    function startMusic() {
        const music = document.getElementById('bgMusic');
        music.play().catch(() => {
            console.log("Music blocked by browser, will play on next interaction.");
        });
        // remove the event listeners once played
        window.removeEventListener('click', startMusic);
        window.removeEventListener('mousemove', startMusic);
        window.removeEventListener('keydown', startMusic);
    }

    // add events to start music
    window.addEventListener('click', startMusic);
    window.addEventListener('mousemove', startMusic);
    window.addEventListener('keydown', startMusic);
</script>
</body>
</html>
