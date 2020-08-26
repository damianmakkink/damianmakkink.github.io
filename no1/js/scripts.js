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
    const airpods = {
        frame: 0
    };

    for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        images.push(img);
    }

    gsap.to(airpods, {
        frame: frameCount - 1,
        snap: "frame",
        scrollTrigger: {
            scrub: 0.5,
            trigger: "#hero-1",
            start: "top top",
            end: "+=5000",
            scrub: 1,
            pin: true,
            snap: {
                snapTo: "labels", // snap to the closest label in the timeline
                duration: {min: 0.2, max: 3}, // the snap animation should be at least 0.2 seconds, but no more than 3 seconds (determined by velocity)
                delay: 0.2, // wait 0.2 seconds from the last scroll event before doing the snapping
                ease: "power1.inOut" // the ease of the snap animation ("power3" by default)
            }
        },
        onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
    });

    images[0].onload = render;

    function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[airpods.frame], 0, 0); 
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
    const airpods = {
        frame: 0
    };

    for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        images.push(img);
    }

    gsap.to(airpods, {
        frame: frameCount - 1,
        snap: "frame",
        scrollTrigger: {
            scrub: 0.5,
            trigger: "#hero-2",
            start: "top top",
            end: "+=5000",
            scrub: 1,
            pin: true,
            snap: {
                snapTo: "labels", // snap to the closest label in the timeline
                duration: {min: 0.2, max: 3}, // the snap animation should be at least 0.2 seconds, but no more than 3 seconds (determined by velocity)
                delay: 0.2, // wait 0.2 seconds from the last scroll event before doing the snapping
                ease: "power1.inOut" // the ease of the snap animation ("power3" by default)
            }
        },
        onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
    });

    images[0].onload = render;

    function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[airpods.frame], 0, 0); 
    }
}

video2();
video1();