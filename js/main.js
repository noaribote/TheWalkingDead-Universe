document.addEventListener('DOMContentLoaded', () => {
  const sections = [...document.querySelectorAll('.OTHERSsections')];
  const indicators = [...document.querySelectorAll('.section-indicator')];
  const scrollThreshold = window.innerWidth <= 865 ? 200 : 500;
  const transitionDuration = 1000;
  let currentIndex = Math.max(0, sections.findIndex(section => section.classList.contains('is-active')));
  let accumulatedScroll = 0;
  let isScrolling = false;
  let lastTouchY = 0;

  if (!sections.length) return;

  const updateIndicators = activeIndex => {
    indicators.forEach((indicator, index) => {
      indicator.classList.toggle('fa-solid', index === activeIndex);
      indicator.classList.toggle('fa-regular', index !== activeIndex);
      indicator.style.color = index === activeIndex ? 'white' : '';
    });
  };

  const loadAndPlayVideos = section => {
    section.querySelectorAll('video').forEach(video => {
      const source = video.querySelector('source');

      if (source?.dataset.src && !source.src) {
        source.src = source.dataset.src;
        video.load();
      }

      video.play().catch(() => {});
    });
  };

  const stopVideos = section => {
    section.querySelectorAll('video').forEach(video => {
      video.pause();
      video.currentTime = 0;
    });
  };

  const navigateTo = (nextIndex, direction) => {
    if (nextIndex === currentIndex) return;

    const outgoingSection = sections[currentIndex];
    const incomingSection = sections[nextIndex];
    const isMovingDown = direction === 'down';

    outgoingSection.style.animation = `${isMovingDown ? 'slideOut' : 'slideOut2'} 1s forwards`;
    incomingSection.style.display = 'block';
    incomingSection.style.animation = `${isMovingDown ? 'slideIn' : 'slideIn2'} 1s forwards`;

    stopVideos(outgoingSection);
    loadAndPlayVideos(incomingSection);
    currentIndex = nextIndex;
    updateIndicators(currentIndex);

    window.setTimeout(() => {
      outgoingSection.style.display = 'none';
    }, transitionDuration);
  };

  const handleScroll = deltaY => {
    if (isScrolling || deltaY === 0) return;

    accumulatedScroll += Math.abs(deltaY);
    if (accumulatedScroll < scrollThreshold) return;

    isScrolling = true;
    const direction = deltaY > 0 ? 'down' : 'up';
    const offset = direction === 'down' ? 1 : -1;
    const nextIndex = (currentIndex + offset + sections.length) % sections.length;

    navigateTo(nextIndex, direction);
    window.setTimeout(() => {
      accumulatedScroll = 0;
      isScrolling = false;
    }, transitionDuration);
  };

  window.addEventListener('wheel', event => handleScroll(event.deltaY), { passive: true });
  window.addEventListener('touchstart', event => {
    lastTouchY = event.touches[0].clientY;
  }, { passive: true });
  window.addEventListener('touchmove', event => {
    const touchY = event.touches[0].clientY;
    handleScroll(lastTouchY - touchY);
    lastTouchY = touchY;
  }, { passive: true });

  indicators.forEach((indicator, index) => {
    indicator.closest('button')?.addEventListener('click', () => {
      const direction = index >= currentIndex ? 'down' : 'up';
      navigateTo(index, direction);
      accumulatedScroll = 0;
    });
  });

  sections.forEach((section, index) => {
    section.style.display = index === currentIndex ? 'block' : 'none';
  });

  updateIndicators(currentIndex);
  loadAndPlayVideos(sections[currentIndex]);
});

const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from { transform: translateY(100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  @keyframes slideOut {
    from { transform: translateY(0); opacity: 1; }
    to { transform: translateY(-100%); opacity: 0; }
  }

  @keyframes slideIn2 {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  @keyframes slideOut2 {
    from { transform: translateY(0); opacity: 1; }
    to { transform: translateY(100%); opacity: 0; }
  }

  .OTHERSsections { animation-fill-mode: forwards; }
`;
document.head.appendChild(style);

function OpenNAVABR() {
  const modal = document.getElementById('myModal');
  if (!modal) return;

  modal.style.display = 'block';
  document.body.style.overflowY = 'hidden';

  const closeModal = () => {
    modal.style.display = 'none';
    document.body.style.overflowY = 'hidden';
  };

  modal.querySelector('.close')?.addEventListener('click', closeModal, { once: true });
  window.addEventListener('click', event => {
    if (event.target === modal) closeModal();
  }, { once: true });
}
