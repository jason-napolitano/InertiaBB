/**
 * Do two arrays have matching keys?
 *
 * @param a {any[]} The first array
 * @param b {any[]} The second array
 */
export const equals = (a: any[], b: any[]) =>
  Array.isArray(a) &&
  Array.isArray(b) &&
  a.length === b.length &&
  a.every((val, index) => val === b[index])

/**
 *
 *
 * @param array
 * @param index
 */
export const lastItemIsIndex = (array: any[], index: number): boolean =>
  array.length - 1 !== index
