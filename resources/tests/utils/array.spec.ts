import { describe, expect, test } from '@jest/globals'
import * as array from '../../utils/array'

// scoped variables -->
let original: any[]
let modified: any[]
let expected: any

// test-suite -->
describe('Testing the array utility library', () => {
  // test -->
  test('Two arrays should be completely identical', () => {
    original = [1, 2, 3]
    modified = [1, 2, 3]
    expect(array.equals(original, modified)).toBeTruthy()
  })

  // test -->
  test('An array should be imploded into a string', () => {
    original = ['jason', 'bill', 'aaron']
    expected = 'jason,bill,aaron'
    expect(array.implode(original)).toEqual(expected)
  })
})
