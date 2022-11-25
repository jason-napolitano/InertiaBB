import { describe, expect, test } from '@jest/globals'
import * as number from '../../utils/number'

// scoped variables -->
let original: number = 12000
let modified: number|string

// test-suite -->
describe('Testing the number utility library', () => {
  // test -->
  test('A number should be converted to a comma-separated string (based on thousands value)', () => {
    modified = '12,000'
    expect(number.thousandsSeparator(original)).toEqual(modified)
  })
})
