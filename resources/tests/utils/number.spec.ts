import { describe, expect, test } from '@jest/globals'
import * as number from '../../utils/number'
import * as string from '@/utils/string'

// scoped constants -->
let expected: number | string
let original: number
let modified: number

// test-suite -->
describe('Testing the number utility library', () => {
  // test -->
  test('A number should be converted to a comma-separated string (based on thousands value)', () => {
    const expected = '12,000'
    expect(number.thousandsSeparator(12000)).toEqual(expected)
  })
})
