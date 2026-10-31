window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.controls[data-video-ids]').forEach(controls => {
    const videoIds = JSON.parse(controls.dataset.videoIds);
    const videos = videoIds
      .map(videoId => document.getElementById(videoId))
      .filter(Boolean);
    const audioVideo = videos[0];
    const muteButton = controls.querySelector('.btn');
    const volumeControl = controls.querySelector('.volume-control');

    if (!videos.length || !muteButton || !volumeControl) return;

    const keepBackgroundVideosMuted = () => {
      videos.slice(1).forEach(video => {
        video.muted = true;
      });
    };

    const updateMuteIcon = () => {
      const iconClass = audioVideo.muted ? 'fa-volume-xmark' : 'fa-volume-high';
      muteButton.innerHTML = `<i class="fa-solid ${iconClass}"></i>`;
    };

    muteButton.addEventListener('click', () => {
      audioVideo.muted = !audioVideo.muted;
      keepBackgroundVideosMuted();
      updateMuteIcon();
    });

    volumeControl.addEventListener('input', () => {
      const volume = Number(volumeControl.value);
      audioVideo.volume = volume;
      audioVideo.muted = volume === 0;
      keepBackgroundVideosMuted();
      updateMuteIcon();
    });

    keepBackgroundVideosMuted();
    updateMuteIcon();
  });
});
