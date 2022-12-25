import { describe, expect, test } from '@jest/globals'
import can from '../../utils/can'

// scoped constants
let original: any
let modified: any
let expected: any

// test-suite -->
describe('Test suite description', () => {

    // test -->
    test('Test description', () => {
        expect(modified).toEqual(expected)
    })
})