// Assignment2
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

float TORAD = PI / 180;

//include "Tga.h"
typedef	struct
{
	GLubyte	* imageData;									// Image Data (Up To 32 Bits)
	GLuint	bpp;											// Image Color Depth In Bits Per Pixel
	GLuint	width;											// Image Width
	GLuint	height;											// Image Height
	GLuint	texID;											// Texture ID Used To Select A Texture
	GLuint	type;											// Image Type (GL_RGB, GL_RGBA)
} Texture;

typedef struct
{
	GLubyte Header[12];									// TGA File Header
} TGAHeader;


typedef struct
{
	GLubyte		header[6];								// First 6 Useful Bytes From The Header
	GLuint		bytesPerPixel;							// Holds Number Of Bytes Per Pixel Used In The TGA File
	GLuint		imageSize;								// Used To Store The Image Size When Setting Aside Ram
	GLuint		temp;									// Temporary Variable
	GLuint		type;
	GLuint		Height;									//Height of Image
	GLuint		Width;									//Width ofImage
	GLuint		Bpp;									// Bits Per Pixel
} TGA;


TGAHeader tgaheader;									// TGA header
TGA tga;										// TGA image data



GLubyte uTGAcompare[12] = { 0,0,2, 0,0,0,0,0,0,0,0,0 };	// Uncompressed TGA Header


bool LoadTGA(Texture * texture, char * filename)				// Load a TGA file
{
	FILE * fTGA;												// File pointer to texture file
	fTGA = fopen(filename, "rb");								// Open file for reading

	if (fTGA == NULL)											// If it didn't open....
	{
		return false;														// Exit function
	}

	if (fread(&tgaheader, sizeof(TGAHeader), 1, fTGA) == 0)					// Attempt to read 12 byte header from file
	{
		if (fTGA != NULL)													// Check to seeiffile is still open
		{
			fclose(fTGA);													// If it is, close it
		}
		return false;														// Exit function
	}

	// an Uncompressed TGA image
	if (fread(tga.header, sizeof(tga.header), 1, fTGA) == 0)					// Read TGA header
	{
		if (fTGA != NULL)													// if file is still open
		{
			fclose(fTGA);													// Close it
		}
		return false;														// Return failular
	}

	texture->width = tga.header[1] * 256 + tga.header[0];					// Determine The TGA Width	(highbyte*256+lowbyte)
	texture->height = tga.header[3] * 256 + tga.header[2];					// Determine The TGA Height	(highbyte*256+lowbyte)
	texture->bpp = tga.header[4];										// Determine the bits per pixel
	tga.Width = texture->width;										// Copy width into local structure						
	tga.Height = texture->height;										// Copy height into local structure
	tga.Bpp = texture->bpp;											// Copy BPP into local structure

	if ((texture->width <= 0) || (texture->height <= 0) || ((texture->bpp != 24) && (texture->bpp != 32)))	// Make sure all information is valid
	{
		if (fTGA != NULL)													// Check if file is still open
		{
			fclose(fTGA);													// If so, close it
		}
		return false;														// Return failed
	}

	if (texture->bpp == 24)													// If the BPP of the image is 24...
		texture->type = GL_RGB;											// Set Image type to GL_RGB
	else																	// Else if its 32 BPP
		texture->type = GL_RGBA;											// Set image type to GL_RGBA

	tga.bytesPerPixel = (tga.Bpp / 8);									// Compute the number of BYTES per pixel
	tga.imageSize = (tga.bytesPerPixel * tga.Width * tga.Height);		// Compute the total amout ofmemory needed to store data
	texture->imageData = (GLubyte *)malloc(tga.imageSize);					// Allocate that much memory

	if (texture->imageData == NULL)											// If no space was allocated
	{
		fclose(fTGA);														// Close the file
		return false;														// Return failed
	}

	if (fread(texture->imageData, 1, tga.imageSize, fTGA) != tga.imageSize)	// Attempt to read image data
	{
		if (texture->imageData != NULL)										// If imagedata has data in it
		{
			free(texture->imageData);										// Delete data from memory
		}
		fclose(fTGA);														// Close file
		return false;														// Return failed
	}

	// switch R and B
	for (int i = 0; i < tga.imageSize; i += tga.bytesPerPixel)
	{
		GLubyte temp = texture->imageData[i];
		texture->imageData[i] = texture->imageData[i + 2];
		texture->imageData[i + 2] = temp;
	}


	fclose(fTGA);															// Close file
	return true;															// All went well, continue on
}
//============================End Tga.h===================================================

float	ColorArr[COLORNUM][3] = { { 1.0, 0.0, 0.0 },{ 0.0, 1.0, 0.0 },{ 0.0,  0.0, 1.0 },
{ 1.0, 1.0,  0.0 },{ 1.0, 0.0, 1.0 },{ 0.0, 1.0, 1.0 },
{ 0.3, 0.3, 0.3 },{ 0.5, 0.5, 0.5 },{ 0.9,  0.9, 0.9 },
{ 1.0, 0.5,  0.5 },{ 0.5, 1.0, 0.5 },{ 0.5, 0.5, 1.0 },
{ 0.0, 0.0, 0.0 },{ 1.0, 1.0, 1.0 }
};

int	screenWidth = 600;
int	screenHeight = 600;

bool	bWireFrame = false;
bool	light2 = true;
bool	smooth = true;

int		nSlice = 40;
int		nStack = 40;
float	angleRotated = 2;//set angle change

//Support class
class Vector3
{
	public:
	float	x, y, z;
	void set(float dx, float dy, float dz)
	{
		x = dx; y = dy; z = dz;
	}
	void set(Vector3& v)
	{
		x = v.x; y = v.y; z = v.z;
	}
	void flip()
	{
		x = -x; y = -y; z = -z;
	}

	Vector3() { x = y = z = 0; }
	Vector3(float dx, float dy, float dz)
	{
		x = dx; y = dy; z = dz;
	}
	Vector3(Vector3& v)
	{
		x = v.x; y = v.y; z = v.z;
	}

	//TO DO
	//Hàm hien thuc tim vector c=axb (tich co huong 2 vector)
	Vector3 Vector3::cross(Vector3 b)
	{
		Vector3 c(y*b.z - z*b.y, z*b.x - x*b.z, x*b.y - y*b.x);
		return c;
	}
	//Ham hien thuc tim tich vo huong cua 2 vector
	float Vector3::dot(Vector3 b)
	{
		return x*b.x + y*b.y + z*b.z;
	}
	//Ham tinh vector don vi, chuan hoa 
	void Vector3::normalize()
	{
		float temp = sqrt(x*x + y*y + z*z); // tinh do dai cua vector 
		x = x / temp;
		y = y / temp;
		z = z / temp;
	}
};
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
	//Lab5
	Vector3		facenorm;//chua phap tuyen cua mat, 
						//cac dinh thuoc cung mat se dung chung 1 phap tuyen

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

	Vector3*	smoothNorm;//vector phap tuyen diem

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
		smoothNorm = NULL;
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
		if (smoothNorm != NULL)
		{
			delete[] smoothNorm;
		}
		numVerts = 0;
		numFaces = 0;
	}

	//TO DO

	void DrawWireframe()
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

	void DrawColor()
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

	void DrawChooseColor(int index)
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

	void SetColor(int colorIdx) {
		for (int f = 0; f < numFaces; f++)
		{
			for (int v = 0; v < face[f].nVerts; v++)
			{
				face[f].vert[v].colorIndex = colorIdx;
			}
		}
	}

	void CreateCylinder(int nSegment, float fHeight, float fRadius)
	{
		//tong so dinh hinh tru
		numVerts = 2 * nSegment + 2;
		//khoi tao mang chua cac phap tuyen diem
		smoothNorm = new Vector3[numVerts];
		for (int i = 0; i < numVerts; i++)
			smoothNorm[i] = Vector3();
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

	void CreateTorus(int nSlice, int nStack, float R, float r) {

		float angleSlice = 360.0 / nSlice;
		float angleStack = 360.0 / nStack;
		//Verts
		numVerts = nSlice*nStack;
		pt = new Point3[numVerts];
		//khoi tao mang chua cac phap tuyen diem
		smoothNorm = new Vector3[numVerts];
		for (int i = 0; i < numVerts; i++)
			smoothNorm[i] = Vector3();

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
	//Lab 5
	void CalculateFacesNorm() //tinh phap tuyen moi mat luoi da giac
	{
		//tinh bang phuong phap Newell
		for (int faceIndex = 0; faceIndex<numFaces; faceIndex++) 
		{
			int N = face[faceIndex].nVerts; // so dinh cua mat

			//tinh phap tuyen cho moi mat
			float mx = 0, my = 0, mz = 0;//khoi tao
			//Tinh phap tuyen cua mat 1-->N-2
			for (int i = N-1; i > 0; i--) {
				int vIndex = face[faceIndex].vert[i].vertIndex;
				int vIndexNext = face[faceIndex].vert[i - 1].vertIndex;
				mx += (pt[vIndex].y - pt[vIndexNext].y)*(pt[vIndex].z + pt[vIndexNext].z);
				my += (pt[vIndex].z - pt[vIndexNext].z)*(pt[vIndex].x + pt[vIndexNext].x);
				mz += (pt[vIndex].x - pt[vIndexNext].x)*(pt[vIndex].y + pt[vIndexNext].y);
			}
			//Tinh phap tuyen cua mat N-1
			int vIndexN = face[faceIndex].vert[N-1].vertIndex;
			int vIndex0 = face[faceIndex].vert[0].vertIndex;
			mx += (pt[vIndexN].y - pt[vIndex0].y)*(pt[vIndexN].z + pt[vIndex0].z);
			my += (pt[vIndexN].z - pt[vIndex0].z)*(pt[vIndexN].x + pt[vIndex0].x);
			mz += (pt[vIndexN].x - pt[vIndex0].x)*(pt[vIndexN].y + pt[vIndex0].y);
			//Set phap tuyen cho mat
			face[faceIndex].facenorm.set(mx, my, mz);
			//Chuan hoa phap tuyen
			face[faceIndex].facenorm.normalize();
		}
	}

	void CalculateSmoothNorm()
	{
		//smooth vertex = sum(faceNorm of all face)
		for (int faceIndex = 0; faceIndex < numFaces; faceIndex++)
		{
			for (int vertIndex = 0; vertIndex < face[faceIndex].nVerts; vertIndex++) {
				int vertCurrent = face[faceIndex].vert[vertIndex].vertIndex;
				smoothNorm[vertCurrent].x += face[faceIndex].facenorm.x;
				smoothNorm[vertCurrent].y += face[faceIndex].facenorm.y;
				smoothNorm[vertCurrent].z += face[faceIndex].facenorm.z;
			}
		}
		//chuan hoa
		for (int i = 0; i < numVerts; i++)
			smoothNorm[i].normalize();
	}

	void Draw() {
		for (int f = 0; f < numFaces; f++) {
			glBegin(GL_POLYGON);
			for (int v = 0; v < face[f].nVerts; v++) {
				int		iv = face[f].vert[v].vertIndex;
				if (smooth == false)
				{
					glNormal3f(face[f].facenorm.x, face[f].facenorm.y, face[f].facenorm.z);
				}
				else
				{
					glNormal3f(smoothNorm[iv].x, smoothNorm[iv].y, smoothNorm[iv].z);
				}
				glVertex3f(pt[iv].x, pt[iv].y, pt[iv].z);
			}
			glEnd();
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

Mesh	floorMesh;
//LAB 4:
float camera_angle;
float camera_height;
float camera_dis;
float camera_X, camera_Y, camera_Z;
float lookAt_X, lookAt_Y, lookAt_Z;
bool	b4View = false;
bool	animation = false;
//LAB 5:

//Nguon sang
//thiet lap nguon sang
GLfloat	lightDiffuse[] = { 1.0f, 1.0f, 1.0f, 1.0f };
GLfloat	lightSpecular[] = { 1.0f, 1.0f, 1.0f, 1.0f };
GLfloat	lightAmbient[] = { 0.4f, 0.4f, 0.4f, 1.0f };
GLfloat light_position1[] = { 60.0f, 60.0f, 60.0f, 0.0f };

GLfloat	lightDiffuse2[] = { 0.0f, 0.0f, 0.0f, 0.0f };
GLfloat	lightSpecular2[] = { 0.0f, 0.0f, 0.0f, 0.0f };
GLfloat	lightAmbient2[] = {0.5f, 0.6f, 0.f, 0.0f };
GLfloat light_position2[] = { 60.0f, 60.0f, -60.0f, 0.0f };

GLfloat red0[]		= { 1.0f, 0.f, 0.f, 1.0f };
GLfloat red1[]		= { 0.8f, 0.f, 0.f, 1.0f };
GLfloat red2[]		= { 0.4f, 0.2f, 0.1f, 0.5f };
GLfloat gray[]		= { 0.7f, 0.7f, 0.7f, 1.0f };
GLfloat green0[]	= { 0.0f, 1.0f, 0.0f, 1.0f };
GLfloat green1[]	= { 0.0f, 0.7f, 0.0f, 1.0f };
GLfloat green2[]	= { 0.0f, 0.4f, 0.0f, 1.0f };
GLfloat pink0[]		= { 0.7f, 0.0f, 0.7f, 1.0f };
GLfloat pink1[]		= { 0.4f, 0.0f, 0.4f, 1.0f };
GLfloat pink2[]		= { 1.0f, 0.0f, 1.0f, 1.0f };
GLfloat blue0[]		= { 0.0f, 0.0f, 1.0f, 1.0f };
GLfloat blue1[]		= { 0.0f, 0.0f, 0.5f, 1.0f };
GLfloat blue2[]		= { 0.0f, 0.0f, 1.0f, 1.0f };
GLfloat yellow[]	= { 1.0f, 1.0f, 0.0f, 1.0f };
GLfloat black[]		= { 0.0f, 0.0f, 0.0f, 1.0f };
GLfloat white[]		= { 1.0f, 1.0f, 1.0f, 1.0f };

Texture   floorTex;
void loadTextures(void) {
	bool status = LoadTGA(&floorTex, "marble.tga");
	if (status) {
		glGenTextures(1, &floorTex.texID);
		glBindTexture(GL_TEXTURE_2D, floorTex.texID);

		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);

		glTexImage2D(GL_TEXTURE_2D, 0, GL_RGB, floorTex.width,
			floorTex.height, 0,
			GL_RGB, GL_UNSIGNED_BYTE, floorTex.imageData);

		if (floorTex.imageData)
			free(floorTex.imageData);
	}
}

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
	/*case 'w':
	case 'W':
		bWireFrame = !bWireFrame;
		break;*/
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
	/*case 'v':
	case 'V':
		if (b4View == true) b4View = false;
		else b4View = true;
		break;*/
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
	case 'd':
	case 'D':
		if (light2 == true)
			light2 = false;
		else
			light2 = true;
		break;
	case 's':
	case 'S':
		smooth = true;
		break;
	case 'f':
	case 'F': 
		smooth = false;
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
 //
 //LAB 5
void setupMaterial(float ambient[], float diffuse[], float specular[], float shiness)
{
	glMaterialfv(GL_FRONT_AND_BACK, GL_AMBIENT, ambient);
	glMaterialfv(GL_FRONT_AND_BACK, GL_DIFFUSE, diffuse);
	glMaterialfv(GL_FRONT_AND_BACK, GL_SPECULAR, specular);
	glMaterialf(GL_FRONT_AND_BACK, GL_SHININESS, shiness);
}
void drawBase()
{
	glPushMatrix();
	//draw
	glTranslated(0, -2.8, 0);
	glRotatef(base.rotateY, 0, 1, 0);
	glTranslated(0, 2.8, 0);
	
	if (bWireFrame)
		base.DrawWireframe();
	else
	{
		//base.DrawChooseColor(2);
		//setupMaterial
		setupMaterial(red2, red1, red0, 100);
		base.Draw();
	}

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
	{
		//baseSupport.DrawChooseColor(3);
		//setupMaterial
		setupMaterial(red2, red1, red0, 100);
		baseSupport.Draw();
	}

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
	{
		//Frame.DrawChooseColor(1);
		//setupMaterial
		setupMaterial(red2, red1, red0, 100);
		Frame.Draw();
	}

	glPopMatrix();
}

void drawFrameSup1() {
	glPushMatrix();

	glRotatef(Frame.rotateY, 0, 1, 0);

	glTranslated(1.75, 2.8, 0);//2.dich len tren, sang trai
	glRotatef(90, 0, 0, 1);//1.quay cho tru nam ngang
	
	if (bWireFrame)
		frameSupport1.DrawWireframe();
	else
	{
		//setupMaterial
		setupMaterial(red2, red1, red0, 100);
		frameSupport1.Draw();
		//frameSupport1.DrawChooseColor(1);
	}		

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
	{
		//frameSupport2.DrawChooseColor(1);
		//setupMaterial
		setupMaterial(red2, red1, red0, 100);
		frameSupport2.Draw();
	}

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
	{
		//setupMaterial
		setupMaterial(blue2, blue1, blue0, 100);
		Gimbal1.Draw();
		//Gimbal1.DrawChooseColor(5);
	}
		

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
	{
		//setupMaterial
		setupMaterial(blue2, blue1, blue0, 100);
		gimbal1Support1.Draw();
		//gimbal1Support1.DrawChooseColor(5);
	}

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
	{
		//setupMaterial
		setupMaterial(blue2, blue1, blue0, 100);
		gimbal1Support2.Draw();
		//gimbal1Support2.DrawChooseColor(5);
	}

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
	{
		//Gimbal2.DrawChooseColor(6);
		//setupMaterial
		setupMaterial(green2, green1, green0, 100);
		Gimbal2.Draw();
	}

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
	{
		//setupMaterial
		setupMaterial(green2, green1, green0, 100);
		gimbal2Support.Draw();
		//gimbal2Support.DrawChooseColor(6);
	}

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
	{
		//setupMaterial
		setupMaterial(pink2, pink1, pink0, 100);
		roto.Draw();
		//roto.DrawChooseColor(0);
	}
		

	glPopMatrix();
}

void drawFloor()
{
	glDisable(GL_LIGHTING);
	glEnable(GL_TEXTURE_2D);
	glBindTexture(GL_TEXTURE_2D, floorTex.texID);
	glColor4f(1,1,1, 0.5);

	glBegin(GL_POLYGON);

	glTexCoord2f(0, 1);
	glVertex3f(-30, 0, -30);
	glTexCoord2f(1, 1);
	glVertex3f(-30, 0, 30);
	glTexCoord2f(1, 0);
	glVertex3f(30, 0, 30);
	glTexCoord2f(0, 0);
	glVertex3f(30, 0, -30);

	glEnd();

	glDisable(GL_TEXTURE_2D);
	glEnable(GL_LIGHTING);
}

void drawAssignment1() {
	//drawAxis();
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
	//drawFloor();
}

//do bong
void findShadowMatrix(float groundPlane[4], float light[4])
{
	float  dotShadow;
	float  matrix[4][4];

	dotShadow = groundPlane[0] * light[0] + groundPlane[1] * light[1] + groundPlane[2] * light[2] + groundPlane[3] * light[3];

	matrix[0][0] = dotShadow - light[0] * groundPlane[0];
	matrix[1][0] = - light[0] * groundPlane[1];
	matrix[2][0] = - light[0] * groundPlane[2];
	matrix[3][0] = - light[0] * groundPlane[3];

	matrix[0][1] = - light[1] * groundPlane[0];
	matrix[1][1] = dotShadow - light[1] * groundPlane[1];
	matrix[2][1] = - light[1] * groundPlane[2];
	matrix[3][1] = - light[1] * groundPlane[3];
	 
	matrix[0][2] =  - light[2] * groundPlane[0];
	matrix[1][2] =  - light[2] * groundPlane[1];
	matrix[2][2] = dotShadow - light[2] * groundPlane[2];
	matrix[3][2] = - light[2] * groundPlane[3];

	matrix[0][3] =  - light[3] * groundPlane[0];
	matrix[1][3] =  - light[3] * groundPlane[1];
	matrix[2][3] =  - light[3] * groundPlane[2];
	matrix[3][3] = dotShadow - light[3] * groundPlane[3];

	glMultMatrixf((const GLfloat*)matrix);
}
void drawShadow(GLfloat groundPlane[], GLfloat light1[])
{
	glDisable(GL_LIGHTING);
	glPushMatrix();
	glColor4f(0.4, 0.4, 0.4, 1);
	findShadowMatrix(groundPlane, light1);
	drawAssignment1();
	glPopMatrix();
	glEnable(GL_LIGHTING);
}
void setShadow()
{
	GLfloat groundPlane[] = { 0.0, 1.0, 0.0, 0.0 };
	drawShadow(groundPlane, light_position1);

	if (light2==true) 
	{
		drawShadow(groundPlane, light_position2);
	}
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
		glPushMatrix();
		glScalef(1.0, -1.0, 1.0);
		drawAssignment1();
		glPopMatrix();
		//Tao phan xa
		glEnable(GL_BLEND);
		glBlendFunc(GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA);
		drawFloor();
		glDisable(GL_BLEND);
		//Tao bong
		setShadow();


		if (light2 == true)
		{
			glEnable(GL_LIGHT1);
		}
		else
		{
			glDisable(GL_LIGHT1);
		}
	}
	else
	{
		glViewport(0, screenHeight / 2, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(0, 0, camera_dis, 0, 1, 0, 0, 1, 0);
		drawAssignment1();
		if (light2 == true)
		{
			glEnable(GL_LIGHT1);
		}
		else
		{
			glDisable(GL_LIGHT1);
		}

		glViewport(0, 0, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(0, camera_dis, 0, 0, 1, 0, 0, 0, 1);
		drawAssignment1();
		if (light2 == true)
		{
			glEnable(GL_LIGHT1);
		}
		else
		{
			glDisable(GL_LIGHT1);
		}

		glViewport(screenWidth / 2, screenHeight / 2, screenWidth / 2, screenHeight / 2);
		glLoadIdentity();
		glOrtho(-4, 4, -4, 4, -1000, 1000);
		gluLookAt(camera_dis, 0, 0, 0, 1, 0, 0, 1, 0);
		drawAssignment1();
		if (light2 == true)
		{
			glEnable(GL_LIGHT1);
		}
		else
		{
			glDisable(GL_LIGHT1);
		}

		glViewport(screenWidth / 2, 0, screenWidth / 2.2, screenHeight / 2);
		glLoadIdentity();
		gluPerspective(10, 1, 0.01, 1000);
		gluLookAt(camera_X, camera_Y, camera_Z, 0, 1, 0, 0, 1, 0);
		drawAssignment1();
		if (light2 == true)
		{
			glEnable(GL_LIGHT1);
		}
		else
		{
			glDisable(GL_LIGHT1);
		}

	}

	glFlush();
	glutSwapBuffers();
}

void myInit()
{
	//glEnable(GL_CULL_FACE);
	loadTextures();
	// Nguon sang 1
	glLightfv(GL_LIGHT0, GL_POSITION, light_position1);
	glLightfv(GL_LIGHT0, GL_DIFFUSE, lightDiffuse);
	glLightfv(GL_LIGHT0, GL_AMBIENT, lightAmbient);
	glLightfv(GL_LIGHT0, GL_SPECULAR, lightSpecular);
	//Nguon sang 2
	glLightfv(GL_LIGHT1, GL_POSITION, light_position2);
	glLightfv(GL_LIGHT1, GL_DIFFUSE, lightDiffuse2);
	glLightfv(GL_LIGHT1, GL_AMBIENT, lightAmbient2);
	glLightfv(GL_LIGHT1, GL_SPECULAR, lightSpecular2);

	glEnable(GL_LIGHTING);
	glEnable(GL_LIGHT0);
	if (light2==true)
	{
		glEnable(GL_LIGHT1);
	}
	else
	{
		glDisable(GL_LIGHT1);
	}
	//old code
	glClearColor(1.0f, 1.0f, 1.0f, 1.0f);
	glColor3f(1.0f, 1.0f, 1.0f);

	glFrontFace(GL_CCW);
	glEnable(GL_DEPTH_TEST);

	//glMatrixMode(GL_PROJECTION);
	//glLoadIdentity();

	camera_angle = 1.8*PI;
	camera_height = 15.3;
	camera_dis = 49;

	//glMatrixMode(GL_MODELVIEW);
}

int _tmain(int argc, _TCHAR* argv[])
{
	cout << "1, 2: Rotate the base" << endl;
	cout << "3, 4: Rotate the gimbal 1" << endl;
	cout << "5, 6: Rotate the gimbal 2" << endl;
	cout << "7, 8: Rotate the rotor" << endl;
	cout << "R, r: Reset the Gyroscope" << endl;
	cout << "A, a: Turn on/off animation" << endl;
	/*cout << "V, v: Turn on/off b4View" << endl;
	cout << "W, w: Switch between wireframe and solid mode" << endl;*/
	cout << "D, d: Turn on/off light2" << endl;
	cout << "S, s: Smooth shading" << endl;
	cout << "F, f: Flat shading" << endl;
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
	base.CalculateFacesNorm();
	base.CalculateSmoothNorm();
	//support
	baseSupport.CreateCylinder(20, 0.25, 0.1);
	baseSupport.CalculateFacesNorm();
	baseSupport.CalculateSmoothNorm();
	//frame
	Frame.CreateTorus(nSlice, nStack, 2, 0.1);
	Frame.CalculateFacesNorm();
	Frame.CalculateSmoothNorm();
	frameSupport1.CreateCylinder(20, 0.15, 0.07);
	frameSupport1.CalculateFacesNorm();
	frameSupport1.CalculateSmoothNorm();
	frameSupport2.CreateCylinder(20, 0.15, 0.07);
	frameSupport2.CalculateFacesNorm();
	frameSupport2.CalculateSmoothNorm();
	//gimbal 1
	Gimbal1.CreateTorus(nSlice, nStack, 1.5, 0.1);
	Gimbal1.CalculateFacesNorm();
	Gimbal1.CalculateSmoothNorm();
	gimbal1Support1.CreateCylinder(20, 0.15, 0.07);
	gimbal1Support1.CalculateFacesNorm();
	gimbal1Support1.CalculateSmoothNorm();
	gimbal1Support2.CreateCylinder(20, 0.15, 0.07);
	gimbal1Support2.CalculateFacesNorm();
	gimbal1Support2.CalculateSmoothNorm();
	//gimbal 2
	Gimbal2.CreateTorus(nSlice, nStack, 1.0, 0.1);
	Gimbal2.CalculateFacesNorm();
	Gimbal2.CalculateSmoothNorm();

	gimbal2Support.CreateCylinder(20, 0.9, 0.07);
	gimbal2Support.CalculateFacesNorm();
	gimbal2Support.CalculateSmoothNorm();
	//roto
	roto.CreateCylinder(6, 0.1, 0.5);
	roto.CalculateFacesNorm();
	roto.CalculateSmoothNorm();

	myInit();

	glutKeyboardFunc(myKeyboard);
	glutSpecialFunc(mySpecialKeyboard);
	glutDisplayFunc(myDisplay);
	glutTimerFunc(100, processTimer, 5);
	glutMainLoop();
	return 0;
}
