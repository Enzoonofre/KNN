from mtcnn import MTCNN
from matplotlib import pyplot
from matplotlib.patches import Rectangle

img = pyplot.imread('face.jpg')

detector = MTCNN()
faces = detector.detect_faces(img)

def caixas(img, faces):
  ax = pyplot.gca()
  for face in faces:
    x, y, width, height = face['box']
    rect = Rectangle((x, y), width, height, fill=False, color='red', lw=2)
    ax.add_patch(rect)

    pyplot.imshow(img)

caixas(img, faces)