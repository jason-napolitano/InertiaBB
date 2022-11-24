import { describe, expect, test } from '@jest/globals'
import * as date from '../../utils/date'

// scoped constants
let original: string = '2022-11-09T21:10:13.000000Z'
let expected: string

// test-suite -->
describe('Testing the date utility library', () => {
  // test -->
  test('A laravel timestamp should be converted to human readable date', () => {
    expected = 'Nov 09, 2022'
    expect(date.formatDate(original, 'MMM DD, YYYY')).toEqual(expected)
  })

  // test -->
  test('The current year will be returned', () => {
    expected = 'Nov 09, 2022'
    expect(date.currentYear()).toEqual(2022)
  })
})
