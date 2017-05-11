// Assignment1
// Nguyen Thi Phuong 1527032

#include "stdafx.h"
#include <iostream>
#include <windows.h>
#include <gl.h>
#include <glut.h>
#include <math.h>

using namespace std;

#define PI				3.1415926
#define	COLORNUM		14

float TORAD	= PI/180;

float	ColorArr[COLORNUM][3] = {	{ 1.0, 0.0, 0.0 },{ 0.0, 1.0, 0.0 },{ 0.0,  0.0, 1.0 },
									{ 1.0, 1.0,  0.0 },{ 1.0, 0.0, 1.0 },{ 0.0, 1.0, 1.0 },
									{ 0.3, 0.3, 0.3 },{ 0.5, 0.5, 0.5 },{ 0.9,  0.9, 0.9 },
									{ 1.0, 0.5,  0.5 },{ 0.5, 1.0, 0.5 },{ 0.5, 0.5, 1.0 },
									{ 0.0, 0.0, 0.0 },{ 1.0, 1.0, 1.0 } 
								};

int	screenWidth = 600;
int	screenHeight = 600;

bool	bWireFrame = true;

int		nSlice = 40;
int		nStack = 40;
float	angleRotated = 3;//set angle change

//Support class
class Point3
{
	public:
		float x, y, z;
		void set(float dx, float dy, float dz)
		{
			x = dx; y = dy; z = dz;
		}
		void set(Point3& p)
		{
			x = p.x; y = p.y; z = p.z;
		}
		Point3() { x = y = z = 0; }
		Point3(float dx, float dy, float dz)
		{
			x = dx; y = dy; z = dz;
		}
};
class Color3
{
	public:
		float r, g, b;
		void set(float red, float green, float blue)
		{
			r = red; g = green; b = blue;
		}
		void set(Color3& c)
		{
			r = c.r; g = c.g; b = c.b;
		}
		Color3() { r = g = b = 0; }
		Color3(float red, float green, float blue)
		{
			r = red; g = green; b = blue;
		}
};
//Mesh class
class VertexID
{
	public:
		int		vertIndex;
		int		colorIndex;
};

class Face
{
public:
	int		nVerts;
	VertexID*	vert;

	Face()
	{
		nVerts = 0;
		vert = NULL;
	}
	~Face()
	{
		if (vert != NULL)
		{
			delete[] vert;
			vert = NULL;
		}
		nVerts = 0;
	}
};

class Mesh
{
	public:
		int		numVerts;
		Point3*		pt;

		int		numFaces;
		Face*		face;

		float		slideX, slideY, slideZ;
		float		rotateX, rotateY, rotateZ;
		float		scaleX, scaleY, scaleZ;

	public:
		Mesh()
		{
			numVerts = 0;
			slideX, slideY, slideZ = 0;
			rotateX, rotateY, rotateZ = 0;
			scaleX, scaleY, scaleZ = 0;
			pt = NULL;
			numFaces = 0;
			face = NULL;
		}
		~Mesh()
		{
			if (pt != NULL)
			{
				delete[] pt;
			}
			if (face != NULL)
			{
				delete[] face;
			}
			numVerts = 0;
			numFaces = 0;
		}

		//TO DO
		
		void Mesh::DrawWireframe()
		{
			glPolygonMode(GL_FRONT_AND_BACK, GL_LINE);
			for (int f = 0; f < numFaces; f++)
			{
				glBegin(GL_POLYGON);
				for (int v = 0; v < face[f].nVerts; v++)
				{
					int		iv = face[f].vert[v].vertIndex;

					glVertex3f(pt[iv].x, pt[iv].y, pt[iv].z);
				}
				glEnd();
			}
		}

		void Mesh::DrawColor()
		{
			glPolygonMode(GL_FRONT_AND_BACK, GL_FILL);
			for (int f = 0; f < numFaces; f++)
			{
				glBegin(GL_POLYGON);
				for (int v = 0; v < face[f].nVerts; v++)
				{
					int		iv = face[f].vert[v].vertIndex;
					int		ic = face[f].vert[v].colorIndex;

					ic = f % COLORNUM;

					glColor3f(ColorArr[ic][0], ColorArr[ic][1], ColorArr[ic][2]);
					glVertex3f(pt[iv].x, pt[iv].y, pt[iv].z);
				}
				glEnd();
			}
		}

		void Mesh::DrawChooseColor(int index)
		{
			glPolygonMode(GL_FRONT_AND_BACK, GL_FILL);
			glColor3f(ColorArr[index][0], ColorArr[index][1], ColorArr[index][2]);
			for (int f = 0; f < numFaces; f++)
			{
				glBegin(GL_POLYGON);
				for (int v = 0; v < face[f].nVerts; v++)
				{
					int		iv = face[f].vert[v].vertIndex;
					glVertex3f(pt[iv].x, pt[iv].y, pt[iv].z);
				}
				glEnd();
			}
		}

		void Mesh::SetColor(int colorIdx) {
			for (int f = 0; f < numFaces; f++)
			{
				for (int v = 0; v < face[f].nVerts; v++)
				{
					face[f].vert[v].colorIndex = colorIdx;
				}
			}
		}

		void Mesh::CreateCylinder(int nSegment, float fHeight, float fRadius)
		{
			//tong so dinh hinh tru
			numVerts = 2 * nSegment + 2;
			//khoi tao mang chua tap cac diem trong khong gian 3D
			pt = new Point3[numVerts];
			float fsegment = 360.0 / nSegment;
			float changeRadius = PI / 180.0;
			//gan toa do cho cac diem trong mat cau ben tren
			for (int i = nSegment; i < 2 * nSegment; i++)
			{
				pt[i].set(
					fRadius*cos(changeRadius*(i - nSegment)*fsegment),
					fHeight,
					fRadius*sin(changeRadius*(i - nSegment)*fsegment)
				);
			}
			//gan toa do cho cac diem trong mat cau ben duoi
			for (int i = 0; i < nSegment; i++)
			{
				pt[i].set(
					fRadius*cos(changeRadius*i*fsegment),
					-fHeight,
					fRadius*sin(changeRadius*i*fsegment)
				);

			}
			//gan toa do cho tam 2 duong tron
			pt[2 * nSegment].set(0, -fHeight, 0);
			pt[2 * nSegment + 1].set(0, fHeight, 0);

			// Cac mat cua hinh tru:
			numFaces = 3 * nSegment;
			face = new Face[numFaces];

			for (int i = 0; i < nSegment; i++)
			{
				face[i].nVerts = 4;
				face[i].vert = new VertexID[face[i].nVerts];
				face[i].vert[0].vertIndex = i;
				face[i].vert[1].vertIndex = nSegment + i;
				if (i == nSegment - 1) {
					face[i].vert[2].vertIndex = nSegment;
					face[i].vert[3].vertIndex = 0;
				}
				else {
					face[i].vert[2].vertIndex = nSegment + i + 1;
					face[i].vert[3].vertIndex = i + 1;
				}
				for (int j = 0; j<face[i].nVerts; j++)
					face[0].vert[j].colorIndex = rand() % 14;

			}

			for (int i = nSegment; i < 2 * nSegment; i++) {
				face[i].nVerts = 3;
				face[i].vert = new VertexID[face[i].nVerts];
				face[i].vert[0].vertIndex = 2 * nSegment;
				face[i].vert[1].vertIndex = i - nSegment;
				if (i == 2 * nSegment - 1)
					face[i].vert[2].vertIndex = i - nSegment - nSegment + 1;
				else
					face[i].vert[2].vertIndex = i - nSegment + 1;
				for (int j = 0; i<face[i].nVerts; i++)
					face[0].vert[j].colorIndex = rand() % 14;
			}

			for (int i = 2 * nSegment; i < 3 * nSegment; i++) {
				face[i].nVerts = 3;
				face[i].vert = new VertexID[face[i].nVerts];
				face[i].vert[0].vertIndex = 2 * nSegment + 1;
				face[i].vert[1].vertIndex = i - nSegment;
				if (i == 3 * nSegment - 1)
					face[i].vert[2].vertIndex = i - nSegment - nSegment + 1;
				else
					face[i].vert[2].vertIndex = i - nSegment + 1;
				for (int j = 0; i<face[i].nVerts; i++)
					face[0].vert[j].colorIndex = rand() % 14;
			}

		}

		void Mesh::CreateTorus(int nSlice, int nStack, float R, float r) {

			float angleSlice = 360.0 / nSlice;
			float angleStack = 360.0 / nStack;

			//Verts
			numVerts = nSlice*nStack;
			pt = new Point3[numVerts];

			for (int i = 0; i < nSlice; i++) {
				for (int j = 0; j < nStack; j++) {
					double alpha = angleStack*i*TORAD;
					double beta = angleSlice*j*TORAD;
					int posVert = i*nSlice + j;
					pt[posVert].set((R + r*cos(alpha))*cos(beta),
									r*sin(alpha), 
									(R + r*cos(alpha))*sin(beta));
				}
			}
			//Faces
			numFaces = nSlice*nStack;
			face = new Face[numFaces];

			for (int i = 0; i < nSlice; i++) {
				for (int j = 0; j < nStack; j++) {
					int posFace = i*nSlice + j;
					int indexNext = (j + 1) % nStack;
					int posNext = (i + 1) % nStack*nSlice;
					face[posFace].nVerts = 4;
					face[posFace].vert = new VertexID[face[posFace].nVerts];

					face[posFace].vert[0].vertIndex = posFace;
					face[posFace].vert[1].vertIndex = i*nSlice + indexNext;
					face[posFace].vert[2].vertIndex = posNext + indexNext;
					face[posFace].vert[3].vertIndex = posNext + j;
				}
			}
		}
};

Mesh	base;
Mesh	baseSupport;

Mesh	Frame;
Mesh	frameSupport1;
Mesh	frameSupport2;

Mesh	Gimbal1;
Mesh	gimbal1Support1;
Mesh	gimbal1Support2;

Mesh	Gimbal2;
Mesh	gimbal2Support;

Mesh	roto;
//LAB 4:
float camera_angle;
float camera_height;
float camera_dis;
float camera_X, camera_Y, camera_Z;
float lookAt_X, lookAt_Y, lookAt_Z;
bool	b4View = false;
bool	animation = false;

void RotateAndTranslateGimbal1(float routeFrame, float routeGimbal1)
{
	glTranslated(0, 2.8, 0);//5.tra lai he truc
	glRotatef(routeFrame, 0, 1, 0);//4.tra lai cho frame
	glRotatef(routeGimbal1, 1, 0, 0);//3.quay gimbal1
	glRotatef(-routeFrame, 0, 1, 0);//2.quay frame
	glTranslated(0, -2.8, 0);//1.tinh tien he truc toa do
};
void RotateAndTranslateGimbal2(float routeFrame, float routeGimbal1, float routeGimbal2)
{
	glTranslated(0, 2.8, 0);
	glRotatef(routeFrame, 0, 1, 0);
	glRotatef(routeGimbal1, 1, 0, 0);
	glRotatef(routeGimbal2, 0, 1, 0);
	glRotatef(-routeGimbal1, 1, 0, 0);
	glRotatef(-routeFrame, 0, 1, 0);
	glTranslated(0, -2.8, 0);
};
void drawAxis()
{
	glPushMatrix();

	glColor3f(0, 0, 1);
	glBegin(GL_LINES);
	glColor3f(1, 0, 0);
	glVertex3f(-4, 0, 0);//x
	glVertex3f(4, 0, 0);

	glColor3f(0, 1, 0);
	glVertex3f(0, 0, 0);//y
	glVertex3f(0, 6, 0);

	glColor3f(0, 1, 1);
	glVertex3f(0, 0, -4);//z
	glVertex3f(0, 0, 4);
	glEnd();

	glPopMatrix();
}
void processTimer(int value) {
	if (animation == true)
	{
		base.rotateY += (GLfloat)value;
		if (base.rotateY > 360) base.rotateY = base.rotateY - 360.0f;

		Frame.rotateX += (GLfloat)value;
		if (Frame.rotateX > 360) Frame.rotateX = Frame.rotateX - 360.0f;
		Frame.rotateY += (GLfloat)value;
		if (Frame.rotateY > 360) Frame.rotateY = Frame.rotateY - 360.0f;
		Frame.rotateZ += (GLfloat)value;
		if (Frame.rotateZ > 360) Frame.rotateZ = Frame.rotateZ - 360.0f;

		Gimbal1.rotateX += (GLfloat)value;
		if (Gimbal1.rotateX > 360) Gimbal1.rotateX = Gimbal1.rotateX - 360.0f;
		Gimbal1.rotateY += (GLfloat)value;
		if (Gimbal1.rotateY > 360) Gimbal1.rotateY = Gimbal1.rotateY - 360.0f;
		Gimbal1.rotateZ += (GLfloat)value;
		if (Gimbal1.rotateZ > 360) Gimbal1.rotateZ = Gimbal1.rotateZ - 360.0f;

		Gimbal2.rotateX += (GLfloat)value;
		if (Gimbal2.rotateX > 360) Gimbal2.rotateX = Gimbal2.rotateX - 360.0f;
		Gimbal2.rotateY += (GLfloat)value;
		if (Gimbal2.rotateY > 360) Gimbal2.rotateY = Gimbal2.rotateY - 360.0f;
		Gimbal2.rotateZ += (GLfloat)value;
		if (Gimbal2.rotateZ > 360) Gimbal2.rotateZ = Gimbal2.rotateZ - 360.0f;

		roto.rotateX += (GLfloat)value;
		if (roto.rotateX > 360) roto.rotateX = roto.rotateX - 360.0f;
		roto.rotateY += (GLfloat)value;
		if (roto.rotateY > 360) roto.rotateY = roto.rotateY - 360.0f;
		roto.rotateZ += (GLfloat)value;
		if (roto.rotateZ > 360) roto.rotateZ = roto.rotateZ - 360.0f;
	}
	glutTimerFunc(100, processTimer, 5);
	glutPostRedisplay();
}
void myKeyboard(unsigned char key, int x, int y)
{

	switch (key)
	{
		case '1':
			base.rotateY += angleRotated;
			if (base.rotateY > 360)
				base.rotateY = base.rotateY - 360;

			Frame.rotateY += angleRotated;
			if (Frame.rotateY > 360)
				Frame.rotateY = Frame.rotateY - 360;
			break;
		case '2':
			base.rotateY = base.rotateY - angleRotated;
			if (base.rotateY < 0)
				base.rotateY += 360;

			Frame.rotateY = Frame.rotateY - angleRotated;
			if (Frame.rotateY < 0)
				Frame.rotateY = 360;
			break;
		case '3':
			Gimbal1.rotateX += angleRotated;
			if (Gimbal1.rotateX > 360)
				Gimbal1.rotateX = Gimbal1.rotateX - 360;
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case '4':
			Gimbal1.rotateX = Gimbal1.rotateX - angleRotated;
			if (Gimbal1.rotateX < 0)
				Gimbal1.rotateX = 360;
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case '5':
			Gimbal2.rotateY += angleRotated;
			if (Gimbal2.rotateY > 360)
				Gimbal2.rotateY = Gimbal2.rotateY - 360;
			RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case '6':
			Gimbal2.rotateY = Gimbal2.rotateY - angleRotated;
			if (Gimbal2.rotateY < 0)
				Gimbal2.rotateY = 360;
			RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case '7':
			roto.rotateX += angleRotated;
			if (roto.rotateX > 360)
				roto.rotateX = roto.rotateX - 360;
			RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case '8':
			roto.rotateX = roto.rotateX - angleRotated;
			if (roto.rotateX < 0)
				roto.rotateX = 360;
			RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
			RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
			break;
		case 'w':
		case 'W':
			bWireFrame = !bWireFrame;
			break;
		case 'r':
		case 'R':
			Frame.rotateX = 0;
			Frame.rotateY = 0;
			Frame.rotateZ = 0;

			Gimbal1.rotateX = 0;
			Gimbal1.rotateY = 0;
			Gimbal1.rotateZ = 0;

			Gimbal2.rotateX = 0;
			Gimbal2.rotateY = 0;
			Gimbal2.rotateZ = 0;

			roto.rotateX = 0;
			roto.rotateY = 0;
			roto.rotateZ = 0;

			break;
		case 'v':
		case 'V':
			if (b4View == true) b4View = false;
			else b4View = true;
			break;
		case '+':
			camera_dis += 0.5;
			break;
		case '-':
			camera_dis -= 0.5;
			break;
		case 'a':
		case 'A':
			if (animation == false)
				animation = true;
			else
				animation = false;
			break;
		}
		glutPostRedisplay();
}
void mySpecialKeyboard(int key, int x, int y)
{
	switch (key)
	{
	case GLUT_KEY_UP:
		camera_height += 0.1;
		break;
	case GLUT_KEY_DOWN:
		camera_height -= 0.1;
		break;
	case GLUT_KEY_LEFT:
		camera_angle -= 0.1;
		break;
	case GLUT_KEY_RIGHT:
		camera_angle += 0.1;
		break;
	}
	glutPostRedisplay();
}
void drawBase()
{
	glPushMatrix();
	glTranslated(0, -2.8, 0);
	glRotatef(base.rotateY, 0, 1, 0);
	glTranslated(0, 2.8, 0);

	if (bWireFrame)
		base.DrawWireframe();
	else
		base.DrawChooseColor(2);

	glPopMatrix();
}
void drawSupport()
{
	glPushMatrix();

	glTranslated(0, -2.35, 0);
	glRotatef(base.rotateY, 0, 1, 0);
	glTranslated(0, 2.8, 0);

	if (bWireFrame)
		baseSupport.DrawWireframe();
	else
		baseSupport.DrawChooseColor(3);

	glPopMatrix();
}
//Frame
void drawFrame() {
	glPushMatrix();

	glRotatef(Frame.rotateY, 0, 1, 0);//quay quanh truc Y

	glTranslated(0, 2.8, 0);//move len theo truc Y
	glRotatef(90, 1, 0, 0);//quay quanh truc x mot goc 90 do, khoi tao vi tri ban dau

	if (bWireFrame)
		Frame.DrawWireframe();
	else
		Frame.DrawChooseColor(1);

	glPopMatrix();
}
void drawFrameSup1() {
	glPushMatrix();

	glRotatef(Frame.rotateY, 0, 1, 0);

	glTranslated(1.75,2.8, 0);//2.dich len tren, sang trai
	glRotatef(90, 0, 0, 1);//1.quay cho tru nam ngang

	if (bWireFrame)
		frameSupport1.DrawWireframe();
	else
		frameSupport1.DrawChooseColor(1);

	glPopMatrix();
}
void drawFrameSup2() {
	glPushMatrix();

	glRotatef(Frame.rotateY, 0, 1, 0);

	glTranslated(-1.75, 2.8, 0);//2.dich len tren
	glRotatef(-90, 0, 0, 1);//1.quay cho tru nam ngang

	if (bWireFrame)
		frameSupport2.DrawWireframe();
	else
		frameSupport2.DrawChooseColor(1);

	glPopMatrix();
}
//Gimbal1
void drawGimbal1() {
	glPushMatrix();

	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);

	glRotatef(Frame.rotateY, 0, 1, 0);//3.Quay theo Y cho duoc vi tri khoi tao ban dau
	glTranslated(0, 2.8, 0);//2.tinh tien theo Y
	glRotated(90, 1, 0, 0);//1.quay quanh x- 90

	if (bWireFrame)
		Gimbal1.DrawWireframe();
	else
		Gimbal1.DrawChooseColor(5);

	glPopMatrix();
}

void drawGimbal1Sup1() {
	glPushMatrix();

	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);

	glRotatef(Frame.rotateY, 0, 1, 0);//2
	glTranslated(0, 1.55, 0);//1

	if (bWireFrame)
		gimbal1Support1.DrawWireframe();
	else
		gimbal1Support1.DrawChooseColor(5);

	glPopMatrix();
}

void drawGimbal1Sup2() {

	glPushMatrix();

	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);

	glRotatef(Frame.rotateY, 0, 1, 0);//3.quay theo Y
	glTranslated(0, 4.05, 0);//2.dich len
	glRotatef(180, 1, 0, 0);//1.dua vao tron

	if (bWireFrame)
		gimbal1Support2.DrawWireframe();
	else
		gimbal1Support2.DrawChooseColor(5);

	glPopMatrix();
}

void drawGimbal2() {
	glPushMatrix();

	RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
	//Khoi tao vi tri ban dau
	glRotatef(Frame.rotateY, 0, 1, 0);
	glTranslated(0, 2.8, 0);
	glRotatef(90, 1, 0, 0);

	if (bWireFrame)
		Gimbal2.DrawWireframe();
	else
		Gimbal2.DrawChooseColor(6);

	glPopMatrix();
}

void drawGimbal2Sup() {
	glPushMatrix();

	RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);
	//khoi tao vi tri ban dau
	glRotatef(Frame.rotateY, 0, 1, 0);//3
	glTranslated(0, 2.8, 0);//2
	glRotatef(90, 0, 0, 1);//1

	if (bWireFrame)
		gimbal2Support.DrawWireframe();
	else
		gimbal2Support.DrawChooseColor(6);

	glPopMatrix();
}

void drawRoto() {
	glPushMatrix();

	glTranslated(0, 2.8, 0);
	glRotatef(Frame.rotateY, 0, 1, 0);
	glRotatef(Gimbal1.rotateX, 1, 0, 0);
	glRotatef(Gimbal2.rotateY, 0, 1, 0);
	glRotatef(roto.rotateX, 1, 0, 0);
	glRotatef(-Gimbal2.rotateY, 0, 1, 0);
	glRotatef(-Gimbal1.rotateX, 1, 0, 0);
	glRotatef(-Frame.rotateY, 0, 1, 0);
	glTranslated(0, -2.8, 0);

	RotateAndTranslateGimbal2(Frame.rotateY, Gimbal1.rotateX, Gimbal2.rotateY);
	RotateAndTranslateGimbal1(Frame.rotateY, Gimbal1.rotateX);

	glRotatef(Frame.rotateY, 0, 1, 0);//3
	glTranslated(0, 2.8, 0);//2
	glRotatef(90, 0, 0, 1);//1

	if (bWireFrame)
		roto.DrawWireframe();
	else
		roto.DrawChooseColor(0);

	glPopMatrix();
}
void drawAssignment1() {
	drawAxis();
	drawBase();
	drawSupport();
	//Frame
	drawFrame();
	drawFrameSup1();
	drawFrameSup2();
	//Gimbal1
	drawGimbal1();
	drawGimbal1Sup1();
	drawGimbal1Sup2();
	//Gimbal2
	drawGimbal2();
	drawGimbal2Sup();
	//roto
	drawRoto();
}

void myDisplay()
{
	glMatrixMode(GL_MODELVIEW);
	glLoadIdentity();

	glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

	camera_X = camera_dis*cos(camera_angle);
	camera_Y = camera_height;
	camera_Z = camera_dis*sin(camera_angle);
	if (b4View == false)
	{
		glViewport(0, 0, screenWidth, screenHeight);
		//Chieu phoi canh: goc nhin, width/height, near, far
		gluPerspective(10, 1, 0.01, 1000);
		gluLookAt(camera_X, camera_Y, camera_Z, 0, 2.8, 0, 0, 1, 0);
		drawAssignment1();
	}
	else
	{
		glViewport(0, screenHeight / 2, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(0, 0, camera_dis, 0, 1, 0, 0, 1, 0);
		drawAssignment1();

		glViewport(0, 0, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(0, camera_dis, 0, 0, 1, 0, 0, 0, 1);
		drawAssignment1();

		glViewport(screenWidth / 2, screenHeight / 2, screenWidth / 2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(camera_dis, 0, 0, 0, 1, 0, 0, 1, 0);
		drawAssignment1();

		glViewport(screenWidth / 2, 0, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		gluPerspective(10, 1, 0.01, 1000);
		gluLookAt(camera_X, camera_Y, camera_Z, 0, 1, 0, 0, 1, 0);
		drawAssignment1();

	}

	glFlush();
	glutSwapBuffers();
}

void myInit()
{
	glClearColor(1.0f, 1.0f, 1.0f, 1.0f);
	glColor3f(0.0f, 0.0f, 0.0f);

	glFrontFace(GL_CCW);
	glEnable(GL_DEPTH_TEST);

	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();

	camera_angle = 0.5*PI;
	camera_height = 1.9;
	camera_dis = 50;

	glMatrixMode(GL_MODELVIEW);
}

int _tmain(int argc, _TCHAR* argv[])
{
	cout << "1, 2: Rotate the base" << endl;
	cout << "3, 4: Rotate the gimbal 1" << endl;
	cout << "5, 6: Rotate the gimbal 2" << endl;
	cout << "7, 8: Rotate the rotor" << endl;
	cout << "R, r: Reset the Gyroscope" << endl;
	cout << "A, a: Turn on/off animation" << endl;
	cout << "W, w: Switch between wireframe and solid mode" << endl;
	cout << "-   : Decrease camera_dis" << endl;
	cout << "+   : Increase camera_dis" << endl;
	cout << "Press Left Arrow to decrease camera_angle" << endl;
	cout << "Press Right Arrow to increase camera_angle " << endl;
	cout << "Press Up Arrow to increase camera_height " << endl;
	cout << "Press Down Arrow decrease camera_height " << endl;

	glutInit(&argc, (char**)argv); //initialize the tool kit
	glutInitDisplayMode(GLUT_DOUBLE | GLUT_RGB | GLUT_DEPTH);//set the display mode
	glutInitWindowSize(screenWidth, screenHeight); //set window size
	glutInitWindowPosition(100, 100); // set window position on screen
	glutCreateWindow("Nguyen Thi Phuong 1527032"); // open the screen window

	//base
	base.CreateCylinder(20, 0.25, 0.75);
	base.SetColor(1);
	//support
	baseSupport.CreateCylinder(20, 0.25, 0.1);
	baseSupport.SetColor(2);
	//frame
	Frame.CreateTorus(nSlice, nStack, 2, 0.1);
	frameSupport1.CreateCylinder(20, 0.15, 0.07);
	frameSupport2.CreateCylinder(20, 0.15, 0.07);
	//gimbal 1
	Gimbal1.CreateTorus(nSlice, nStack, 1.5, 0.1);
	gimbal1Support1.CreateCylinder(20, 0.15, 0.07);
	gimbal1Support2.CreateCylinder(20, 0.15, 0.07);
	//gimbal 2
	Gimbal2.CreateTorus(nSlice, nStack, 1.0, 0.1);
	gimbal2Support.CreateCylinder(20, 0.9, 0.07);
	//roto
	roto.CreateCylinder(6, 0.1, 0.5);
	myInit();

	glutKeyboardFunc(myKeyboard);
	glutSpecialFunc(mySpecialKeyboard);
	glutDisplayFunc(myDisplay);
	glutTimerFunc(100, processTimer, 5);
	glutMainLoop();
	return 0;
}
