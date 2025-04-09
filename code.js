const audio = document.getElementById("audio-player");
const playPauseBtn = document.getElementById("play-pause");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const volumeControl = document.getElementById("volume");

// Online song links
const songs = [
    "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3",
    "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3"
];

let songIndex = 0;
audio.src = songs[songIndex]; // Set the first song

// Play & Pause functionality
playPauseBtn.addEventListener("click", () => {
    if (audio.paused) {
        audio.play();
        playPauseBtn.textContent = "⏸️";
    } else {
        audio.pause();
        playPauseBtn.textContent = "▶️";
    }
});

// Next song
nextBtn.addEventListener("click", () => {
    songIndex = (songIndex + 1) % songs.length;
    audio.src = songs[songIndex];
    audio.play();
    playPauseBtn.textContent = "⏸️";
});

// Previous song
prevBtn.addEventListener("click", () => {
    songIndex = (songIndex - 1 + songs.length) % songs.length;
    audio.src = songs[songIndex];
    audio.play();
    playPauseBtn.textContent = "⏸️";
});

// Volume Control
volumeControl.addEventListener("input", () => {
    audio.volume = volumeControl.value;
});
