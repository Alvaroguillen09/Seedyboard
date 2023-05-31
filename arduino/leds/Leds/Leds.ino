// Variables globales
bool stopRandomLEDs = false; // Bandera para detener el bucle de apagado aleatorio
bool stopMoveLED = false; // Bandera para detener el movimiento del LED
unsigned long previousMillis = 0;
unsigned long interval = 5000; // Intervalo de 5 segundos
bool moveLED = false; // Bandera para indicar el movimiento del LED
int ledX = 0; // Posición X actual del LED en la matriz
int ledY = 0; // Posición Y actual del LED en la matriz

#include <Adafruit_NeoPixel.h>

#define PIN 12   // Pin al que está conectado el primer LED
#define NUM_LEDS 96 // Número total de LEDs en la cadena
#define BRIGHTNESS 255 // Brillo máximo de los LEDs (de 0 a 255)

Adafruit_NeoPixel strip = Adafruit_NeoPixel(NUM_LEDS, PIN, NEO_GRB + NEO_KHZ800);

void setup() {
  strip.begin(); // Inicializa la cadena de LEDs
  strip.setBrightness(BRIGHTNESS); // Configura el brillo máximo de los LEDs
  strip.show(); // Actualiza el estado de los LEDs
  Serial.begin(9600); // Inicializa el puerto serie a 9600 bps
}

void loop() {
  if (Serial.available() > 0) { // Verifica si hay datos disponibles en el puerto serie
    String data = Serial.readStringUntil('\n'); // Lee la cadena de datos recibida
    int values[NUM_LEDS]; // Array para almacenar los valores recibidos
    int numValues = 0; // Contador de valores recibidos

    // Establece todos los valores del array en cero
    for (int i = 0; i < NUM_LEDS; i++) {
      values[i] = 0;
    }

    // Convierte la cadena de datos en un array de enteros
    int j = 0; // Utiliza una variable j distinta para evitar conflicto
    for (char * p = strtok(const_cast<char*>(data.c_str()), ","); p != NULL; p = strtok(NULL, ",")) {
      if (j >= NUM_LEDS) {
        break; // Detiene el bucle si se alcanza el número máximo de LEDs
      }
      values[j++] = atoi(p); // Utiliza j en lugar de i
      numValues++;
    }

    // Enciende o apaga los LEDs según los valores recibidos
    strip.fill(strip.Color(0, 0, 0), 0, NUM_LEDS); // Apaga todos los LEDs
    
    int first255Index = -1;
    int last255Index = -1;

    // Enciende los LEDs en función de los valores recibidos
    for (int k = 0; k < numValues; k++) {
      if (values[k] == 255) {
        if (first255Index == -1) {
          first255Index = k; // Guarda la posición del primer 255
        }
        last255Index = k; // Actualiza la posición del último 255
        strip.setPixelColor(k, strip.Color(0, 0, 255)); // Valores 255 en azul
      }
    }

    if (first255Index != -1 && last255Index != -1) {
      strip.setPixelColor(first255Index, strip.Color(255, 0, 0)); // Primer 255 en verde
      strip.setPixelColor(last255Index, strip.Color(0, 255, 0)); // Último 255 en rojo
    }

    strip.show(); // Actualiza el estado de los LEDs

    // Verifica si el valor recibido es igual a 103
if (data.toInt() == 103) {
  // Reinicia la variable stopRandomLEDs a false
  stopRandomLEDs = false;

  // Enciende todos los LEDs con el mismo color
  strip.fill(strip.Color(255, 255, 255), 0, NUM_LEDS);
  strip.show(); // Actualiza el estado de los LEDs

  // Apaga un LED aleatorio cada 5 segundos
  int numLedsOn = NUM_LEDS; // Número de LEDs encendidos inicialmente

  while (numLedsOn > 0 && !stopRandomLEDs) {
    unsigned long currentMillis = millis();

    if (currentMillis - previousMillis >= interval) {
      previousMillis = currentMillis;

      // Apaga un LED aleatorio
      int ledIndex = random(numLedsOn);
      strip.setPixelColor(ledIndex, strip.Color(0, 0, 0));
      strip.show(); // Actualiza el estado del LED

      numLedsOn--;
    }

    // Verifica si se insertó una nueva ruta a través del puerto serie
    if (Serial.available() > 0) {
      String newData = Serial.readStringUntil('\n');
      // Si se inserta una nueva ruta, abandona el bucle
      if (newData != "") {
        stopRandomLEDs = true;
        break;
      }
    }
  }
}

    // Verifica si el valor recibido es igual a 104
if (data.toInt() == 104) {
  // Reinicia la variable stopMoveLED a false
  stopMoveLED = false;

  // Apaga todos los LEDs en la matriz
  strip.fill(strip.Color(0, 0, 0), 0, NUM_LEDS);
  strip.show(); // Actualiza el estado de los LEDs

  // Enciende un LED aleatorio en la matriz
  ledX = random(12);
  ledY = random(8);
  int ledIndex = ledY * 12 + ledX;
  strip.setPixelColor(ledIndex, strip.Color(255, 255, 255));
  strip.show(); // Actualiza el estado del LED

  // Inicia el movimiento del LED
  moveLED = true;

  while (moveLED) {
    // Apaga el LED en la posición actual
    int ledIndex = ledY * 12 + ledX;
    strip.setPixelColor(ledIndex, strip.Color(0, 0, 0));

    // Genera un movimiento aleatorio en las direcciones X y Y
    int randomMovementX = random(-2, 3); // Genera un número aleatorio entre -2 y 2 para el movimiento en X
    int randomMovementY = random(-2, 3); // Genera un número aleatorio entre -2 y 2 para el movimiento en Y

    // Calcula la nueva posición del LED
    int newLedX = ledX + randomMovementX;
    int newLedY = ledY + randomMovementY;

    // Verifica que la nueva posición esté dentro del rango válido de la matriz
    if (newLedX >= 0 && newLedX < 12 && newLedY >= 0 && newLedY < 8) {
      ledX = newLedX;
      ledY = newLedY;
    }

    // Enciende el LED en la nueva posición
    int newLedIndex = ledY * 12 + ledX;
    strip.setPixelColor(newLedIndex, strip.Color(255, 255, 255));
    strip.show(); // Actualiza el estado del LED

    // Verifica si se insertó una nueva ruta a través del puerto serie
    if (Serial.available() > 0) {
      String newData = Serial.readStringUntil('\n');
      // Si se inserta una nueva ruta, abandona el bucle
      if (newData != "") {
        stopMoveLED = true;
        break;
      }
    }

    delay(3000); // Retardo de medio segundo entre movimientos

    // Verifica si se debe detener el movimiento del LED
    if (stopMoveLED) {
      break;
    }
  }
}

    // Verifica si el valor recibido es igual a 105
    if (data.toInt() == 105) {
      // Apaga todos los LEDs en la matriz
      strip.fill(strip.Color(0, 0, 0), 0, NUM_LEDS);
      strip.show(); // Actualiza el estado de los LEDs
      if (Serial.available() > 0) {
      String newData = Serial.readStringUntil('\n');
      // Si se inserta una nueva ruta, abandona el bucle
      if (newData != "") {
        stopMoveLED = true;
      }
    }
    }

  }
}