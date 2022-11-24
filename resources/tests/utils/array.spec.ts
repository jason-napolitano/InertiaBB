import { describe, expect, test } from '@jest/globals'
import * as array from '../../utils/array'

// test-suite -->
describe('Testing the array utility library', () => {
  // test -->
  test('Two arrays should be completely identical', () => {
    const array_one = [1, 2, 3],
      array_two = [1, 2, 3]
    expect(array.equals(array_one, array_two)).toBeTruthy()
  })

  // test -->
  test('Two arrays should NOT be completely identical', () => {
    const array_one = [1, 2, 3, 4],
      array_two = [1, 2, 3]
    expect(!array.equals(array_one, array_two)).toBeTruthy()
  })
})
