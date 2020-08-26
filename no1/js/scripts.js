function video1() {

    const canvas = document.getElementById("hero-1");
    const context = canvas.getContext("2d");

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const frameCount = 174;
    const currentFrame = index => (
    `img/frames1/ezgif-frame-${(index + 1).toString().padStart(3, '0')}.jpg`
    );

    const images = []
    const bike = {
        frame: 0
    };

    for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        images.push(img);
    }

    gsap.to(bike, {
        frame: frameCount - 1,
        snap: "frame",
        scrollTrigger: {
            scrub: 0.5,
            trigger: "#hero-1",
            start: "bottom bottom",
            end: "+=5000",
            scrub: 1,
            pin: true
        },
        onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
    });

    images[0].onload = render;

    function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[bike.frame], 0, 0); 
    }
}

function video2() {

    const canvas = document.getElementById("hero-2");
    const context = canvas.getContext("2d");

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const frameCount = 142;
    const currentFrame = index => (
    `img/frames2/ezgif-frame-${(index + 1).toString().padStart(3, '0')}.jpg`
    );

    const images = []
    const bike = {
        frame: 0
    };

    for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        images.push(img);
    }

    gsap.to(bike, {
        frame: frameCount - 1,
        snap: "frame",
        scrollTrigger: {
            scrub: 0.5,
            trigger: "#hero-2",
            start: "top top",
            end: "+=5000",
            scrub: 1,
            pin: true
        },
        onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
    });

    images[0].onload = render;

    function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[bike.frame], 0, 0); 
    }
}

video2();
video1();