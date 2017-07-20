d=document
b=d.body
c=a.getContext("2d")
w=a.width=innerWidth
h=a.height=innerHeight
with(Math)S=sin,C=cos,Q=sqrt,dg=PI/180,M=min
rot=0;
drot=dg

~function loop(t) {
  j=/*S(t*1e-4) * 1*/0 
  c.fillStyle='#000'
	c.fillRect(0,0,w,h)
	c.save();
	c.translate(w/2, h/2)
	c.rotate(rot*dg)
	for (i=360;i--;) {
		c.rotate(dg*i)
		c.translate(1,0)
		c.scale(1.005+S(t/5e2)/1e3,1)
    c.globalCompositeOperation='lighter'
		c.fillStyle='hsla('+i*36+',75%,'+(67-i/3)+'%,0.3)'
		c.fillRect(-100+(j+360-i)*C((rot-i)*dg), -100+(j+360-i)*S((rot-i)*dg), 200-i/3, 200-i/3)
	}
	rot = rot+drot
	drot=M(drot+dg/10, dg*45)
	c.restore()
	requestAnimationFrame(loop)
}(0)