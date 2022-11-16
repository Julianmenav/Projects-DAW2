<?php

/**
 * Julián Mena
 * Clase Libro
 */

class Libro
{
  private int $puntuacion;
  private string $isbn;
  private string $titulo;
  private string $autor;
  private string $editorial;
  private ?int $paginas;
  private ?string $argumento;
  private ?string $imagen;

  public function __construct()
  {
  }

  public function __get($key): string|int|null
  {
    return $this->$key;
  }

  public function __set($key, $valor)
  {
    $this->$key = $valor;
  }

  // public function __construct(string $isbn, string $titulo, string $autor, string $editorial, int $puntuacion)
  // {
  //   $this->isbm = $isbn;
  //   $this->titulo = $titulo;
  //   $this->autor = $autor;
  //   $this->editorial = $editorial;
  //   $this->puntuacion = $puntuacion;
  // }

  public function estrellas(): string
  {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
  </svg>';
    $emptySvg = '<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
  </svg>';


    return str_repeat($svg, $this->puntuacion) . str_repeat($emptySvg, 5 - $this->puntuacion);
  }
}
