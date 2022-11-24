/**
 * Returns a random number between two numbers
 *
 * @link https://www.php.net/manual/en/function.random-int.php
 *
 * @param min {number}
 * @param max {number}
 *
 * @returns {number}
 */
export const random_int = (min: number, max: number) =>
  Math.floor(Math.random() * (max - min + 1) + min)

/**
 /** --------------------------------------------
 * Parses a number value and returns the
 * corresponding comma-delineated string value
 *
 * @param number {number} The value to parse
 *
 * @returns {string}
 */
export const thousandsSeparator = (number: number) => {
  const num_parts = number.toString().split('.')
  num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',')
  return num_parts.join('.')
}
