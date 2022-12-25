/**
 * Do two arrays have matching keys?
 *
 * @param a {any[]} The first array
 * @param b {any[]} The second array
 */
export const equals = (a: any[], b: any[]) =>
  a.length === b.length && a.every((val, index) => val === b[index])

/**
 * implode an array into a comma separated string
 *
 * @param array
 */
export const implode = (array: string[]): string => String(array)
