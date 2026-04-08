(function() {
    const canvas = document.getElementById('springCanvas');
    if (!canvas) return;
    
    let ctx = canvas.getContext('2d');
    let width, height;
    let spheres = [];
    let rotatingShapes = [];
    let particleField = [];
    let time = 0;
    let currentTheme = 'dark';
    let isMobile = false;
    let animationId = null;
    let lastTimestamp = 0;
    let frameSkip = 0;
    
    // Detect mobile and set quality level
    function detectMobile() {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        isMobile = /android|webos|iphone|ipad|ipod|blackberry|windows phone/i.test(userAgent.toLowerCase());
        
        // Also check screen size
        if (window.innerWidth <= 768) isMobile = true;
        
        return isMobile;
    }
    
    class RotatingSphere {
        constructor(x, y, r, speedX, speedY, speedZ, color, lineCount = 200) {
            this.x = x;
            this.y = y;
            this.radius = r;
            this.speedX = speedX;
            this.speedY = speedY;
            this.speedZ = speedZ;
            this.color = color;
            this.rotX = Math.random() * Math.PI * 2;
            this.rotY = Math.random() * Math.PI * 2;
            this.rotZ = Math.random() * Math.PI * 2;
            this.points = [];
            this.lines = [];
            this.initPoints(isMobile ? Math.floor(lineCount * 0.6) : lineCount);
        }
        
        initPoints(count) {
            this.points = [];
            this.lines = [];
            
            for (let i = 0; i < count; i++) {
                const t = i / count;
                const strandOffset = ((i % 4) / 4) * Math.PI * 2;
                const theta = Math.PI * t;
                const phi = (t * Math.PI * 2 * 6) + strandOffset;
                
                this.points.push({
                    x: Math.sin(theta) * Math.cos(phi),
                    y: Math.cos(theta),
                    z: Math.sin(theta) * Math.sin(phi),
                    theta: theta,
                    phi: phi,
                    thickness: 0.3 + Math.random() * 0.6
                });
            }
            
            // Reduce line count on mobile for better performance
            const maxLines = isMobile ? 800 : 2000;
            let lineCount = 0;
            
            for (let i = 0; i < this.points.length && lineCount < maxLines; i++) {
                for (let j = i + 1; j < this.points.length && lineCount < maxLines; j++) {
                    const p1 = this.points[i];
                    const p2 = this.points[j];
                    const phiDiff = Math.abs(p1.phi - p2.phi);
                    const thetaDiff = Math.abs(p1.theta - p2.theta);
                    if ((phiDiff < 0.12 && thetaDiff < 0.25) || (Math.abs(p1.theta - p2.theta) < 0.08 && phiDiff < 0.4)) {
                        this.lines.push({ p1: p1, p2: p2 });
                        lineCount++;
                    }
                }
            }
        }
        
        updateAndDraw(time, theme) {
            this.rotX += this.speedX;
            this.rotY += this.speedY;
            this.rotZ += this.speedZ;
            
            // Batch draw lines for better performance
            ctx.beginPath();
            let hasLine = false;
            
            for (let line of this.lines) {
                const p1 = this.projectPoint(line.p1);
                const p2 = this.projectPoint(line.p2);
                if (p1 && p2) {
                    if (!hasLine) {
                        ctx.beginPath();
                        hasLine = true;
                    }
                    ctx.moveTo(p1.x, p1.y);
                    ctx.quadraticCurveTo((p1.x + p2.x) / 2, (p1.y + p2.y) / 2, p2.x, p2.y);
                }
            }
            
            if (hasLine) {
                const opacity = theme === 'dark' ? 0.25 : 0.12;
                ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity})`;
                ctx.lineWidth = isMobile ? 0.8 : 1;
                ctx.stroke();
            }
            
            // Draw points (reduced on mobile)
            const maxPoints = isMobile ? Math.min(this.points.length, 150) : this.points.length;
            for (let i = 0; i < maxPoints; i++) {
                const point = this.points[i];
                const screen = this.projectPoint(point);
                if (screen) {
                    ctx.beginPath();
                    const depth = (screen.z + 1) / 2;
                    const radius = isMobile ? 0.8 * (0.5 + depth * 0.8) : 1.2 * (0.5 + depth * 0.8);
                    ctx.arc(screen.x, screen.y, radius, 0, Math.PI * 2);
                    const glow = theme === 'dark' ? 0.4 : 0.2;
                    ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${glow * (0.3 + depth * 0.5)})`;
                    ctx.fill();
                }
            }
        }
        
        projectPoint(point) {
            let x = point.x;
            let y = point.y;
            let z = point.z;
            
            let x1 = x * Math.cos(this.rotY) + z * Math.sin(this.rotY);
            let z1 = -x * Math.sin(this.rotY) + z * Math.cos(this.rotY);
            let y1 = y;
            
            let y2 = y1 * Math.cos(this.rotX) - z1 * Math.sin(this.rotX);
            let z2 = y1 * Math.sin(this.rotX) + z1 * Math.cos(this.rotX);
            let x2 = x1;
            
            let x3 = x2 * Math.cos(this.rotZ) - y2 * Math.sin(this.rotZ);
            let y3 = x2 * Math.sin(this.rotZ) + y2 * Math.cos(this.rotZ);
            
            const scale = this.radius;
            return {
                x: this.x + x3 * scale,
                y: this.y + y3 * scale,
                z: z2
            };
        }
    }
    
    class RotatingRing {
        constructor(x, y, r, speed, color, tilt = 0) {
            this.x = x;
            this.y = y;
            this.radius = r;
            this.speed = speed;
            this.color = color;
            this.tilt = tilt;
            this.angle = 0;
            this.points = [];
            const segments = isMobile ? 60 : 120;
            for (let i = 0; i <= segments; i++) {
                const t = (i / segments) * Math.PI * 2;
                this.points.push({
                    x: Math.cos(t),
                    y: Math.sin(t) * Math.cos(tilt),
                    z: Math.sin(t) * Math.sin(tilt)
                });
            }
        }
        
        updateAndDraw(theme) {
            this.angle += this.speed;
            
            ctx.beginPath();
            let hasLine = false;
            
            for (let i = 0; i < this.points.length; i++) {
                const p1 = this.points[i];
                const p2 = this.points[(i + 1) % this.points.length];
                
                const x1 = p1.x * Math.cos(this.angle) - p1.z * Math.sin(this.angle);
                const z1 = p1.x * Math.sin(this.angle) + p1.z * Math.cos(this.angle);
                const y1 = p1.y;
                
                const x2 = p2.x * Math.cos(this.angle) - p2.z * Math.sin(this.angle);
                const z2 = p2.x * Math.sin(this.angle) + p2.z * Math.cos(this.angle);
                const y2 = p2.y;
                
                if (!hasLine) {
                    ctx.beginPath();
                    hasLine = true;
                }
                ctx.moveTo(this.x + x1 * this.radius, this.y + y1 * this.radius);
                ctx.lineTo(this.x + x2 * this.radius, this.y + y2 * this.radius);
            }
            
            if (hasLine) {
                const opacity = theme === 'dark' ? 0.3 : 0.12;
                ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity})`;
                ctx.lineWidth = isMobile ? 0.8 : 1;
                ctx.stroke();
            }
        }
    }
    
    class RotatingCube {
        constructor(x, y, size, speedX, speedY, color) {
            this.x = x;
            this.y = y;
            this.size = size;
            this.speedX = speedX;
            this.speedY = speedY;
            this.color = color;
            this.rotX = 0;
            this.rotY = 0;
            const s = size;
            this.vertices = [
                {x: -s, y: -s, z: -s}, {x:  s, y: -s, z: -s},
                {x:  s, y: -s, z:  s}, {x: -s, y: -s, z:  s},
                {x: -s, y:  s, z: -s}, {x:  s, y:  s, z: -s},
                {x:  s, y:  s, z:  s}, {x: -s, y:  s, z:  s}
            ];
            this.edges = [[0,1],[1,2],[2,3],[3,0],[4,5],[5,6],[6,7],[7,4],[0,4],[1,5],[2,6],[3,7]];
        }
        
        updateAndDraw(theme) {
            this.rotX += this.speedX;
            this.rotY += this.speedY;
            
            const projected = this.vertices.map(v => {
                let y1 = v.y * Math.cos(this.rotX) - v.z * Math.sin(this.rotX);
                let z1 = v.y * Math.sin(this.rotX) + v.z * Math.cos(this.rotX);
                let x1 = v.x;
                let x2 = x1 * Math.cos(this.rotY) + z1 * Math.sin(this.rotY);
                let z2 = -x1 * Math.sin(this.rotY) + z1 * Math.cos(this.rotY);
                return { x: this.x + x2, y: this.y + y1, z: z2 };
            });
            
            ctx.beginPath();
            let hasLine = false;
            
            for (let edge of this.edges) {
                const p1 = projected[edge[0]];
                const p2 = projected[edge[1]];
                if (!hasLine) {
                    ctx.beginPath();
                    hasLine = true;
                }
                ctx.moveTo(p1.x, p1.y);
                ctx.lineTo(p2.x, p2.y);
            }
            
            if (hasLine) {
                const opacity = theme === 'dark' ? 0.35 : 0.15;
                ctx.strokeStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${opacity})`;
                ctx.lineWidth = isMobile ? 0.8 : 1.2;
                ctx.stroke();
            }
        }
    }
    
    function getScaledValue(value, mobileScale = 0.6) {
        return isMobile ? value * mobileScale : value;
    }
    
    function getResponsivePosition(pos, isWidth = true) {
        if (typeof pos === 'string') {
            if (pos === 'center') return isWidth ? width / 2 : height / 2;
            if (pos === 'quarter') return isWidth ? width * 0.25 : height * 0.25;
            if (pos === 'threeQuarter') return isWidth ? width * 0.75 : height * 0.75;
            if (pos === 'fifth') return isWidth ? width * 0.2 : height * 0.2;
            if (pos === 'fourFifth') return isWidth ? width * 0.8 : height * 0.8;
            if (pos === 'sixth') return isWidth ? width * 0.15 : height * 0.15;
            if (pos === 'fiveSixth') return isWidth ? width * 0.85 : height * 0.85;
        }
        return pos;
    }
    
    function resizeCanvas() {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
        
        if (!spheres.length) return;
        
        // Responsive sphere sizes based on screen dimensions
        const baseSize = Math.min(width, height);
        const sphereScale = isMobile ? 0.4 : 0.5;
        
        spheres[0].x = width / 2;
        spheres[0].y = height / 2;
        spheres[0].radius = baseSize * (isMobile ? 0.35 : 0.4);
        
        spheres[1].x = getResponsivePosition('fifth', true);
        spheres[1].y = getResponsivePosition('quarter', false);
        spheres[1].radius = baseSize * (isMobile ? 0.15 : 0.18);
        
        spheres[2].x = getResponsivePosition('fourFifth', true);
        spheres[2].y = getResponsivePosition('threeQuarter', false);
        spheres[2].radius = baseSize * (isMobile ? 0.18 : 0.22);
        
        spheres[3].x = getResponsivePosition('fiveSixth', true);
        spheres[3].y = getResponsivePosition('fifth', false);
        spheres[3].radius = baseSize * (isMobile ? 0.12 : 0.14);
        
        spheres[4].x = getResponsivePosition('sixth', true);
        spheres[4].y = getResponsivePosition('fourFifth', false);
        spheres[4].radius = baseSize * (isMobile ? 0.13 : 0.15);
        
        if (spheres[5]) {
            spheres[5].x = getResponsivePosition('threeQuarter', true);
            spheres[5].y = getResponsivePosition('quarter', false);
            spheres[5].radius = baseSize * (isMobile ? 0.1 : 0.12);
        }
        
        // Responsive ring sizes
        if (rotatingShapes[0]) {
            rotatingShapes[0].x = width / 2;
            rotatingShapes[0].y = height / 2;
            rotatingShapes[0].radius = baseSize * (isMobile ? 0.42 : 0.48);
            
            rotatingShapes[1].x = width / 2;
            rotatingShapes[1].y = height / 2;
            rotatingShapes[1].radius = baseSize * (isMobile ? 0.44 : 0.5);
            
            rotatingShapes[2].x = getResponsivePosition('quarter', true);
            rotatingShapes[2].y = getResponsivePosition('quarter', false);
            rotatingShapes[2].radius = baseSize * (isMobile ? 0.13 : 0.15);
            
            rotatingShapes[3].x = getResponsivePosition('threeQuarter', true);
            rotatingShapes[3].y = getResponsivePosition('threeQuarter', false);
            rotatingShapes[3].radius = baseSize * (isMobile ? 0.15 : 0.17);
            
            // Cube positions and sizes
            rotatingShapes[4].x = getResponsivePosition('quarter', true);
            rotatingShapes[4].y = getResponsivePosition('threeQuarter', false);
            rotatingShapes[4].size = baseSize * (isMobile ? 0.07 : 0.08);
            
            rotatingShapes[5].x = getResponsivePosition('threeQuarter', true);
            rotatingShapes[5].y = getResponsivePosition('quarter', false);
            rotatingShapes[5].size = baseSize * (isMobile ? 0.06 : 0.07);
            
            rotatingShapes[6].x = width / 2;
            rotatingShapes[6].y = getResponsivePosition('fourFifth', false);
            rotatingShapes[6].size = baseSize * (isMobile ? 0.055 : 0.065);
        }
        
        // Reset particles on resize
        if (particleField.length) {
            const particleCount = isMobile ? 80 : 150;
            particleField = [];
            for (let i = 0; i < particleCount; i++) {
                particleField.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: (Math.random() - 0.5) * 0.3,
                    vy: (Math.random() - 0.5) * 0.3,
                    size: 0.5 + Math.random() * (isMobile ? 1 : 1.5)
                });
            }
        }
    }
    
    function init() {
        detectMobile();
        
        const baseSize = Math.min(window.innerWidth, window.innerHeight);
        const sphereScale = isMobile ? 0.35 : 0.4;
        
        spheres = [
            new RotatingSphere(width/2, height/2, baseSize * sphereScale, 0.002, 0.003, 0.0015, {r:164,g:96,b:191}, isMobile ? 250 : 400),
            new RotatingSphere(width*0.2, height*0.25, baseSize * 0.15, 0.003, 0.002, 0.004, {r:170,g:171,b:220}, isMobile ? 120 : 200),
            new RotatingSphere(width*0.8, height*0.7, baseSize * 0.18, 0.0025, 0.0035, 0.002, {r:200,g:150,b:220}, isMobile ? 150 : 250),
            new RotatingSphere(width*0.85, height*0.2, baseSize * 0.12, 0.004, 0.003, 0.005, {r:180,g:120,b:200}, isMobile ? 90 : 150),
            new RotatingSphere(width*0.15, height*0.8, baseSize * 0.13, 0.0035, 0.0025, 0.003, {r:150,g:100,b:180}, isMobile ? 100 : 180),
            new RotatingSphere(width*0.75, height*0.45, baseSize * 0.1, 0.005, 0.004, 0.003, {r:190,g:130,b:210}, isMobile ? 70 : 120)
        ];
        
        rotatingShapes = [
            new RotatingRing(width/2, height/2, baseSize * 0.42, 0.004, {r:164,g:96,b:191}, Math.PI/3),
            new RotatingRing(width/2, height/2, baseSize * 0.44, -0.003, {r:170,g:171,b:220}, Math.PI/4),
            new RotatingRing(width*0.25, height*0.3, baseSize * 0.13, 0.005, {r:180,g:120,b:200}, Math.PI/2),
            new RotatingRing(width*0.75, height*0.7, baseSize * 0.15, -0.004, {r:200,g:150,b:220}, Math.PI/5),
            new RotatingCube(width*0.3, height*0.6, baseSize * 0.07, 0.003, 0.005, {r:164,g:96,b:191}),
            new RotatingCube(width*0.7, height*0.35, baseSize * 0.06, -0.004, 0.003, {r:170,g:171,b:220}),
            new RotatingCube(width*0.5, height*0.8, baseSize * 0.055, 0.005, -0.003, {r:190,g:130,b:210})
        ];
        
        const particleCount = isMobile ? 80 : 150;
        particleField = [];
        for (let i = 0; i < particleCount; i++) {
            particleField.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                size: 0.5 + Math.random() * (isMobile ? 1 : 1.5)
            });
        }
    }
    
    function draw() {
        if (!ctx) return;
        
        // Throttle frame rate on mobile for better battery life
        if (isMobile) {
            frameSkip++;
            if (frameSkip < 2) {
                animationId = requestAnimationFrame(draw);
                return;
            }
            frameSkip = 0;
        }
        
        ctx.clearRect(0, 0, width, height);
        
        // Optimized gradient for mobile
        const gradient = ctx.createLinearGradient(0, 0, width, height);
        if (currentTheme === 'dark') {
            gradient.addColorStop(0, 'rgba(10, 10, 15, 0.95)');
            gradient.addColorStop(1, 'rgba(15, 8, 25, 0.95)');
        } else {
            gradient.addColorStop(0, 'rgba(245, 240, 255, 0.95)');
            gradient.addColorStop(1, 'rgba(240, 230, 255, 0.95)');
        }
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
        
        // Connection lines between spheres (reduced on mobile)
        if (!isMobile || time % 2 === 0) {
            for (let i = 0; i < spheres.length; i++) {
                for (let j = i + 1; j < spheres.length; j++) {
                    const dx = spheres[i].x - spheres[j].x;
                    const dy = spheres[i].y - spheres[j].y;
                    const distance = Math.sqrt(dx*dx + dy*dy);
                    const maxDistance = isMobile ? 300 : 400;
                    
                    if (distance < maxDistance) {
                        ctx.beginPath();
                        ctx.moveTo(spheres[i].x, spheres[i].y);
                        ctx.quadraticCurveTo((spheres[i].x+spheres[j].x)/2, (spheres[i].y+spheres[j].y)/2, spheres[j].x, spheres[j].y);
                        const opacity = currentTheme === 'dark' ? (isMobile ? 0.1 : 0.15) : (isMobile ? 0.05 : 0.08);
                        ctx.strokeStyle = `rgba(164, 96, 191, ${opacity})`;
                        ctx.lineWidth = isMobile ? 0.5 : 0.8;
                        ctx.stroke();
                    }
                }
            }
        }
        
        // Draw all shapes
        for (let shape of rotatingShapes) shape.updateAndDraw(currentTheme);
        for (let sphere of spheres) sphere.updateAndDraw(time, currentTheme);
        
        // Draw particles (reduced on mobile)
        const particleLimit = isMobile ? particleField.length : particleField.length;
        for (let i = 0; i < particleLimit; i++) {
            const p = particleField[i];
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0) p.x = width;
            if (p.x > width) p.x = 0;
            if (p.y < 0) p.y = height;
            if (p.y > height) p.y = 0;
            
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            const opacity = currentTheme === 'dark' ? (isMobile ? 0.2 : 0.3) : (isMobile ? 0.1 : 0.15);
            ctx.fillStyle = `rgba(164, 96, 191, ${opacity})`;
            ctx.fill();
        }
        
        time += isMobile ? 0.015 : 0.02;
        animationId = requestAnimationFrame(draw);
    }
    
    // Theme observer
    const themeObserver = new MutationObserver(() => {
        currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
    });
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
    
    // Handle resize with debounce for better performance
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            resizeCanvas();
        }, isMobile ? 150 : 100);
    });
    
    // Handle visibility change - pause animation when tab is inactive
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            // Cancel animation when hidden to save resources
            if (animationId) {
                cancelAnimationFrame(animationId);
                animationId = null;
            }
        } else {
            // Restart animation when visible
            if (!animationId) {
                time = 0;
                animationId = requestAnimationFrame(draw);
            }
        }
    });
    
    // Initialize
    currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';
    detectMobile();
    resizeCanvas();
    init();
    draw();
})();